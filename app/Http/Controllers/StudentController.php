<?php
namespace App\Http\Controllers;

use PDF;
use File;
use Mail;
use Excel;
use DataTables;
use ZipArchive;
use Carbon\Carbon;
use App\Mail\TestMail;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Exports\StudentExport;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\AssignOp\Div;

class StudentController extends Controller
{

    public function __construct()
{
    set_time_limit(8000000);
}

    public function index()
    {
        return view('welcome');
    }
   
    public function getStudents(Request $request)
    {
        if ($request->ajax()) {
            $data = Student::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn =
                        '<a href="'.route("students.edit").'/'.'?cus='. $row->id .'" class="edit btn btn-success m-1 p-1">Edit</a>';
                    $actionBtn = 
                    $actionBtn.'<a href="'.route("students.edit").'/'.'?cus='. $row->id .'" class="edit btn btn-info m-1 p-1">view</a>';
                    $actionBtn =
                        $actionBtn.'<form action="'.route("students.delete", $row->id).'" method="get">
                        <button type="submit" class="delete btn btn-danger mx-3 p-1">Delete</button>
                        </form>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    
    public function editStudents()
    {
        return view('welcome');
    }

    public function deleteStudents($id)
    {
        // dd($id);
        $record = Student::where('id', $id)->first();
        // dd($record);
        if ($record) {
            $record->delete();
            return redirect('/')->with('success', 'Record deleted successfully');
        } else {
            return redirect('/')->with('error', 'Record not found');
        }
    }

    public function email(Request $request)
    {
        //===== Delete All Files from temp and zipfiles =====//

        $files = File::allFiles(public_path('temp'));
        foreach ($files as $file) {
            $fileName = $file->getPathname();
            if(File::exists($fileName)){
                File::delete($fileName);
            }
            // else{
            //     dd('else');
            //     dd('File does not exists.');
            // }
        }

        $zipfiles = public_path('zipfiles/attachments.zip');
        File::delete($zipfiles);
        // dd('Zip files deleted');
        //===== End Delete All Files from temp and zipfiles =====//

        //===== Generate file and Store in temporary folder =====//

        // $filename = 'Example.xlsx';
        // $path = public_path('temp/'.$filename);
        // dump($path);

        // $path = public_path('temp/test');
        
        // if (!is_dir($path)) {
        //     mkdir($path, 0777, true);
        // }
        // dump($path);
        $filename = 'Students.xlsx';
        Excel::store(new StudentExport, $filename, 'public_uploads');
        // dd($excel);

        // $student = DB::table('students')
        // ->select('name', 'email', 'username', 'phone', 'dob') ->get();
        //----- Time Formate in AM and PM -----//
        // $time = $now->format('g:i A');
        $student  = Student::get();
        $today = Carbon::now('Asia/Karachi')->format('d-m-y - g:i A');
        $Studentsdata =[
            'title' => 'All Students Record',
            'today'  => $today,
            'Student' => $student
        ];
        $pdf = PDF::loadView('students.student_pdf',$Studentsdata);
        $pdf->save('students.pdf', 'public_uploads');

        //===== End Generate file and Storein temporary folder =====//


        //======== Create Zip File ========//

        $zip = new ZipArchive;
        $zipFileName = 'zipfiles/attachments.zip';
        if ($zip->open(public_path($zipFileName), ZipArchive::CREATE) === TRUE) {
            $files = File::allFiles(public_path('temp'));
            foreach ($files as $file) {
                $fileName = $file->getRelativePathname();
                $zip->addFile($file->getPathname(), $fileName);
            }
            $zip->close();
        }

        //====== End Create Zip File =====//
        
        $Title = 'This is test Mail From Aamir shahzad';
        $details = [
            'title' => $Title,
            'body' => 'PDF student records provide an efficient and organized way for educational institutions to store and share important student information. These digital documents include personal information, and other relevant details in a compact and easily accessible format',
            'email' =>'Aamir@gmail.com',
            'button'  => 'Thanks for using our website',
            'url' => 'http://localhost:8000',
            'reply' => 'TestMail@gmail.com',
            'name' => 'TestMail',
            'zipFilePath' => public_path($zipFileName),
        ];
        // $files = public_path('attachments/admin.jpg');
        // $pdf = public_path('attachments/hexatec.pdf');

        $files = [
            public_path('attachments/admin.jpg'),
            public_path('attachments/hexatec.pdf'),
        ];

        $ccEmails = ["demo@gmail.com", "demo2@gmail.com"];
        $bccEmails = ["demo3@gmail.com", "demo4@gmail.com"];
        // dd($files);
       
        // Mail::to('your_receiver_email@gmail.com')
        //     ->cc($ccEmails)
        //     ->bcc($bccEmails)
        //     ->send(new TestMail($details,$files));
        Mail::send('email.mail', ['details' => $details, 'ccEmails' => $ccEmails, 'bccEmails' => $bccEmails ], function($message)use($details, $files, $ccEmails, $bccEmails) {
            $message->to($details["email"])
                    ->subject($details["title"])
                    ->cc($ccEmails)
                    ->bcc($bccEmails)
                    ->attach($details["zipFilePath"]);
 
            foreach ($files as $file){
                $message->attach($file);
            }            
        });
            return redirect('/')->with('success', 'Email Send successfully');
        
        // dd("Email is Sent.");
        // return view('email');
    }
}