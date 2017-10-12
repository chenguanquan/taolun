<?php

namespace App\Http\Controllers;

use App\comment;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //判断是否登录
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $content = Student::get();

        return view('home' , [
            'contents' => $content,
        ]);
    }


    public function launch(Request $request)
    {
        if(Auth::check()){
            if($request->isMethod('POST')){
                $user = Auth::user()->name;
                $discuss = $request->input('discuss');

                if($discuss == null){
                    echo "<script>alert('请输入需要讨论的内容！');history.go(-1);</script>";
                }else{
                    $content = new Student();
                    $content->user = $user;
                    $content->content = $discuss;

                    if($content->save()){
                        return redirect()->back();
                    } else {
                        return redirect()->back();
                    }
                }
            }
        }else{
            echo "<script>alert('请登录后再发起讨论！');history.go(-1);</script>";
        }
    }

    public function comment($id)
    {


        $content = Student::find($id);

//        $comment = DB::table('comment')->whereRaw('cont_id = 1')-get();
//        $comment = comment::get();

        $comment = DB::select('select * from discuss where cont_id = ?' , [$id]);


        return view('comment' , [
            'content' => $content,
            'comments' => $comment
        ]);
    }


    public function reply($id , Request $request){


        if(Auth::check()){
            if($request->isMethod('POST')){
                $user = Auth::user()->name;
                $discuss = $request->input('comment');
                $cont_id = $id;

                if($discuss == null){
                    echo "<script>alert('请输入需要评论的内容！');history.go(-1);</script>";
                }else{
                    $content = new comment();
                    $content->user = $user;
                    $content->neirong = $discuss;
                    $content->cont_id = $cont_id;

                    if($content->save()){
                        return redirect()->back();
                    } else {
                        return redirect()->back();
                    }
                }
            }
        }else{
            echo "<script>alert('请登录后再发起讨论！');history.go(-1);</script>";
        }

    }



    public function delect($id)
    {

//        $comment = DB::select('select * from discuss where cont_id = ?' , [$id]);

        $comments = Student::find($id)->comments();

        Student::find($id)->delete();

        if($comments->delete()){

            return redirect()->back();
        }


    }



    public function delete_yanlun($id)
    {
        $comment = comment::find($id);

        if($comment->delete()){
            return redirect()->back();
        }
    }





}
