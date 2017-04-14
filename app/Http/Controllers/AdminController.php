<?php

namespace App\Http\Controllers;

use App\Answer;
use App\AnswerReport;
use App\Feedback;
use App\Question;
use App\QuestionReport;
use Illuminate\Http\Request;
use App\Note;
use App\Http\Requests;
use App\Major;
use App\Course;
use App\User;
use App\AdminMail;
use Mail;
use Session;
use Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth_admin');
    }

    public function index()
    {
        return view('admin.list');
    }

    public function add_course_page()
    {
        $courses = Course::all();
        $majors = Major::all();

        return view('admin.add_course', compact(['courses', 'majors']));
    }


    public function add_course(Request $request)
    {
//        dd($request);
        $this->validate($request, [
            'course_code' => 'alpha_num|required',
            'course_name' => 'required',
            'semester' => 'numeric|between:1,10|required',
            'majors.*' => 'numeric|exists:majors,id'
        ]);

        $course = new Course();
        $course->course_code = $request->course_code;
        $course->course_name = $request->course_name;
        $course->semester = $request->semester;
        $course->save();
        $course->majors()->attach($request->majors);
        return redirect('admin/add_course');
    }

    public function delete_course($id)
    {
        $course = Course::find($id);
        $course->delete();
        return redirect('/admin/add_course');
    }

    public function update_course_page($id)
    {

        $course = Course::find($id);
        $majors = Major::all();

        $course_majors = array();
        foreach ($course->majors()->get() as $major)
            $course_majors[] = $major->id;

        return view('admin.update_course', compact(['course', 'majors', 'course_majors']));

    }

    public function update_course($id, Request $request)
    {
        $this->validate($request, [
            'course_code' => 'alpha_num|required',
            'course_name' => 'required',
            'semester' => 'numeric|between:1,10|required',
            'majors.*' => 'numeric|exists:majors,id'
        ]);

        $course = Course::find($id);
        $course->course_code = $request->course_code;
        $course->course_name = $request->course_name;
        $course->semester = $request->semester;
        $course->save();
        $course->majors()->detach();
        $course->majors()->attach($request->majors);
        return redirect('admin/add_course');
    }


    public function add_major_page()
    {
        $majors = Major::all();
        return view('admin.add_major', compact(['courses', 'majors']));
    }

    public function add_major(Request $request)
    {
        $this->validate($request, [
            'faculty' => 'required',
            'major' => 'required',
        ]);
        $major = new Major();
        $major->faculty = $request->faculty;
        $major->major = $request->major;
        $major->save();
        return redirect('/admin/add_major');
    }

    public function delete_major($id)
    {
        $major = Major::find($id);
        $major->delete();
        return redirect('/admin/add_major');
    }

    public function update_major_page($id)
    {
        $major = Major::find($id);
        return view('admin.update_major', compact(['major']));
    }

    public function update_major($id, Request $request)
    {
        $this->validate($request, [
            'faculty' => 'required',
            'major' => 'required',
        ]);

        $major = Major::find($id);
        $major->faculty = $request->faculty;
        $major->major = $request->major;
        $major->save();
        return redirect('admin/add_major');
    }


    public function view_feedbacks()
    {
        $feedbacks = Feedback::all();
        return view('admin.feedbacks', compact(['feedbacks']));
    }

    public function view_reports()
    {
        $question_reports = QuestionReport::all();
        $answer_reports = AnswerReport::all();
        return view('admin.reports', compact(['question_reports', 'answer_reports']));
    }


    public function manyMailView()
    {
        $users = User::where('confirmed', '>=', '1')->get();
        return view('admin.mail_many', compact(['users']));
    }

    public function oneMailView($id)
    {
        $user = User::find($id);
        return view('admin.mail_one', compact(['user']));
    }

    public function processMailToUsers(Request $request, $type)
    {


        if ($type == 0) {
            $sendMail = $this->sendMailToOneUser($request->user_id, $request->mail_subject, $request->mail_content);
            if ($sendMail) {
                Session::flash('mail', 'Mail sent successfully');
                return redirect(url('user/' . $request->user_id));
            } else {
                Session::flash('mail', 'Error sending mail');
                return redirect(url('admin/mail/one/' . $request->user_id));
            }
        } else {
            $sendMail = $this->sendMailToManyUsers($request->users, $request->mail_subject, $request->mail_content);
            if ($sendMail) {
                Session::flash('mail', 'Mail sent successfully');
                return redirect(url('admin/'));
            } else {
                Session::flash('mail', 'Error sending mail');
                return redirect(url('admin/mail/many/'));
            }
        }


    }


    public function sendMailToOneUser($user_id, $mail_subject, $mail_content)
    {
        $user = User::find($user_id);

        $sendMail = Mail::send('admin.emails.general', ['mail_content' => $mail_content, 'name' => $user->first_name], function ($message) use ($user, $mail_subject, $mail_content) {
            $message->to($user->email, $user->first_name)
                ->subject($mail_subject);
        });
        if ($sendMail) {
            $this->saveMail([$user_id], $mail_subject, $mail_content);
        }

        return $sendMail;

    }


    public function sendMailToManyUsers($users, $mail_subject, $mail_content)
    {

        $usersEmails = [];
        foreach ($users as $user) {
            $usersEmails[] = User::find($user)->email;
        }


        $sendMail = Mail::send('admin.emails.general', ['mail_content' => $mail_content, 'name' => 'awesome AskaFellow member'], function ($message) use ($usersEmails, $mail_subject, $mail_content) {
            $message->to([])->bcc($usersEmails)
                ->subject($mail_subject);
        });

        if ($sendMail) {
            $this->saveMail($users, $mail_subject, $mail_content);
        }

        return $sendMail;


    }


    public function saveMail($recipients, $mail_subject, $mail_body)
    {
        $mail = new AdminMail();
        $mail->user_id = Auth::user()->id;
        $mail->subject = $mail_subject;
        $mail->body = $mail_body;
        $mail->save();
        $mail->recipients()->attach($recipients);
    }


    public function showMailLog()
    {
        $mails = AdminMail::orderBy('created_at', 'desc')->get();
        return view('admin.mail_log', compact(['mails']));
    }


    public function listUsers()
    {
        $users = User::orderBy('first_name', 'asc');
        return view('admin.users', compact(['users']));
    }

    public function add_badge()
    {

        $users = User::orderBy('first_name', 'asc');
        return view('admin.badge', compact(['users']));
    }

    public function save_badge($id)
    {
        $user = User::findOrFail($id);
        $user->verified_badge = 1;
        $user->save();
        $users = User::orderBy('first_name', 'asc');
        return view('admin.badge', compact(['users']));
    }

    public function remove_badge($id)
    {
        $user = User::findOrFail($id);
        $user->verified_badge = 0;
        $user->save();
        $users = User::orderBy('first_name', 'asc');
        return view('admin.badge', compact(['users']));
    }

    public function statistics()
    {
        $questions = Question::all()->count();
        $answers = Answer::all()->count();
        $users = User::all()->count();
        return view('admin.statistics', compact(['questions', 'answers', 'users']));
    }


    public function deleteNoteAdmin($id) {
        $note = Note::find($id);
        $course_id = $note->course_id;
        $note->delete();

        return redirect(url('browse/notes/'. $course_id)); //TODO : appropriate redirection


}


}
