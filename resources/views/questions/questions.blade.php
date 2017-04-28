<?php

//die($questions_ordered);
$page = 0;
if (isset($_GET['page']) && $_GET['page'] > 0)
    $page = $_GET['page'];
$take = 10;
if (isset($_GET['take']) && $_GET['take'] > 0)
    $take = $_GET['take'];

$pages = ceil($count_questions / $take);

$sort = 'latest';
if (isset($_GET['sort']))
    $sort = $_GET['sort'];


?>

@extends('layouts.app')
@section('content')

    <div class="container" style="width:100%;">
        <div class="questions">
            <h3 style="margin-left: 50px">Showing {{count($questions_ordered)}} out of {{$count_questions}}
                Question(s).</h3>

            <div id="filtration_form">
                <form class="" action="">
                    <div class="form-group">
                        <label class="form-label">Order by: </label>
                        <select name="sort" class="form-control">
                            <option {{isset($sort) && $sort == 'votes'?'selected':''}} value="votes">Votes</option>
                            <option {{isset($sort) && $sort == 'answers'?'selected':''}} value="answers">Number of
                                answers
                            </option>
                            <option {{isset($sort) && $sort == 'oldest'?'selected':''}} value="oldest">Oldest</option>
                            <option {{isset($sort) && $sort == 'latest'?'selected':''}} value="latest">Latest</option>
                        </select>
                        <label class="form-label">Questions per page: </label>
                        <input class="form-control" type="number" name="take"
                               value="{{isset($_GET['take'])?$_GET['take']:10}}">
                        <input type="submit" class="btn btn-default" value="Update">
                    </div>
                </form>
            </div>


            <nav class="center-block" style="text-align: center">
                <ul class="pagination">
                    @if($page > 0)
                        <li><a href="?page={{$page - 1}}&take={{$take}}" aria-label="Previous"><span aria-hidden="true">«</span></a>
                        </li>
                    @endif
                    @for($i = 0; $i < $pages; $i++)
                        @if($page == $i)
                            <li class="active"><a href="?page={{$i}}&take={{$take}}&sort={{$sort}}">{{$i + 1}} <span
                                            class="sr-only">(current)</span></a></li>
                        @else
                            <li><a href="?page={{$i}}&take={{$take}}&sort={{$sort}}">{{$i + 1}}</a></li>
                        @endif

                    @endfor
                    @if($page < $pages - 1)
                        <li class="{{$page >= $pages-1? 'disabled':''}}"><a href="#" aria-label="Next"><span
                                        aria-hidden="true">»</span></a></li>
                    @endif
                </ul>
            </nav>
            @foreach($questions_ordered as $question)
                <div href="{{url('answers/'.$question->id)}}" class="media question">
                    <div style="text-align: center" class="media-left">

                        <a href="{{url('user/'.$question->asker_id)}}">

                            @if($question->asker->profile_picture)
                                <img class="media-object" src="{{asset($question->asker->profile_picture)}}" alt="...">

                            @else
                                <img class="media-object" src="{{asset('art/default_pp.png')}}" alt="...">
                            @endif
                        </a>
                        @if(Auth::user())
                            <a class="upvote_question vote" value="{{$question->id}}" title="upvote"
                               style="color:green;"><span class="glyphicon glyphicon-thumbs-up"></span></a>
                        @endif
                        @if($question->votes > 0)
                            <span class="question_votes" style="color:green;">{{$question->votes}} </span>
                        @elseif($question->votes == 0)
                            <span class="question_votes" style="">{{$question->votes}} </span>
                        @else
                            <span class="question_votes" style="color:red;">{{$question->votes}} </span>
                        @endif
                        @if(Auth::user())
                            <a class="downvote_question vote" value="{{$question->id}}" title="downvote"
                               style="color:red"><span class="glyphicon glyphicon-thumbs-down"></span></a>
                        @endif
                    </div>
                    <div class="media-body" style="cursor: pointer;">
                        @if(Auth::user())
                            <div class="delete_question pull-right">
                                @if(Auth::user()->id == $question->asker_id || Auth::user()->role >= 1)

                                    <a onclick="return confirm('Are you sure?');" title="Delete question"
                                       href="{{url('delete_question/'.$question->id)}}"><span style="color:#FFAF6C"
                                                                                              class="glyphicon glyphicon-remove"></span></a>

                                @endif
                                <a value="{{$question->id}}" data-toggle="modal" data-target="#report_modal"
                                   class="report_question" title="Report question"><span style="color:#D24848;"
                                                                                         class="glyphicon glyphicon-ban-circle"></span></a>
                            </div>
                        @endif
                            @if($question->asker->verified_badge >=1)
                                <h3>{{$question->asker->first_name.' '.$question->asker->last_name}} <span class="verified"></span></h3>
                            @else
                                <h3>{{$question->asker->first_name.' '.$question->asker->last_name}} </h3>
                            @endif
                        @if(isset($all))
                            <h5 style="color:green">{{$question->course->course_code}}</h5>
                        @endif
                        <div class="question_text">
                            {{$question->question}}
                        </div>
                        <p style="font-weight: bold; font-style: italic; ">{{ date("F j, Y, g:i a",strtotime($question->created_at)) }} </p>
                    </div>


                </div>

            @endforeach

            <div id="report_modal" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="" style="background-color:rgba(255,255,255,0.9)">

                        <button style="margin-right:15px;margin:top:10px;" type="button" class="close"
                                data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>


                        <br>
                        <div class="modal-body" style="padding: 0 50px 40px 50px;">
                            <h3>Report question </h3>
                            <div class="form-group" style="width: 50%;">
                                <input type="radio" name="reason" value="Contains inappropriate content"> Contains
                                inappropriate content<br>
                                <input type="radio" name="reason" value="Contains misleading information"> Contains
                                misleading information<br>
                                <input type="radio" name="reason" value="Contains violent speech"> Contains violent
                                speech<br>
                                <input type="radio" name="reason" value="Contains hateful content"> Contains hateful
                                content<br>
                                <input type="radio" id="report_other" name="reason" value="Other"> Other<br>
                                <textarea class="form-control" id="report_other_text"></textarea>
                                <input type="hidden" id="reported_question_id" value="">


                            </div>

                            <button id="submit_report" class="btn btn-default">Send</button>
                            @include('errors')
                        </div>
                        <!-- <div class="modal-footer"> -->

                        <!-- </div> -->
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>

            <form id="post_question_form" action="" method="POST">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="post_question_text">Ask a question:</label>
                    <textarea required class="form-control" id="post_question_text" name="question"
                              placeholder="Type your question here"></textarea>
                    <input type="submit" value="Post Question" class="btn btn-default pull-right"
                           id="post_question_submit">
                    @if(isset($all))
                        <div class="form-group" style="width:50%;">
                            <label for="course" style="">Post question to: </label>
                            <select id="course" class="form-control" name="course">
                                @foreach($courses as $course)
                                    <option value="{{$course->id}}">{{$course->course_name}}</option>

                                @endforeach
                            </select>
                        </div>
                    @endif
                </div>
            </form>

        </div>

    </div>



    <style>
        #filtration_form {
            width: 20%;
            float: right;
            /*display: inline-block;*/

        }

        .question {
            background-color: #FFF5E9;
            padding: 15px;
            margin-left: 80px;
            width: 70%;
            /*min-width: 200px;*/
            margin-bottom: 10px;
        }

        .question img {
            width: 50px;
            height: 50px;
            border-radius: 100px;
            margin-bottom: 10px;
        }

        .question h3 {
            /*width: 100%;*/
            font-size: 18px;
            margin-top: 2px;
            color: #621708;
            /*font-weight: bold;*/
        }

        .question .question_text {
            font-size: 15px;
            max-width: 600px;
        }

        .vote {
            cursor: pointer;
        }

        .question .media-body {
            cursor: pointer;
        }

        .question:hover {
            background-color: #F5E0C2;
        }

        #post_question_form {
            width: 60%;
            margin-left: 90px;
            margin-top: 50px;
        }

        #post_question_form textarea {
            resize: none;
            height: 150px;
            font-size: 18px;
        }

        #post_question_form #post_question_submit {
            background-color: #FFE9CF;
            border: 1px solid #CCB69C;
            margin-top: 10px;
        }

        #post_question_form #post_question_submit:focus {
            background-color: #CCB69C;
            /*border: 1px solid #CCB69C !important;*/

        }

        .pagination a {
            color: #E66900 !important;
            background-color: #FDF9F3 !important;
        }

        .pagination .active a {
            background-color: #FFAF6C !important;
            border-color: #CC8C39;
            color: #BD5D0D !important;
        }
        .media img+span.badge {
            position: relative;
            top: -8px;
            left: 8px;
        }

        #filtration_form {
            min-width: 150px;
        }

        @media (max-width: 800px) {
            .question, #post_question_form {
                margin-left: -30px;
                min-width: 300px;
                width: 90%;
            }

        }
        span.verified{
            display: inline-block;
            vertical-align: middle;
            height: 40px;
            width: 40px;
            background-image: url("{{asset('art/ver.png')}}");
            background-repeat: no-repeat;
            z-index: 200000;

        }

    </style>

    <script>
        $(document).ready(function () {
            $('#report_other_text').hide();
        });


        $('input[name=reason]').on('change', function () {
            if ($(this).val() == 'Other')
                $('#report_other_text').show();
            else
                $('#report_other_text').hide();
        });

        var reported_question_id = 1;
        $('.report_question').click(function () {
            reported_question_id = $(this).attr('value');

        });
        $('#submit_report').click(function () {
            var reason = $('input[name=reason]:checked').val();
            var other = $('#report_other_text').val();
            $.ajax({
                type: "GET",
                url: "{{url('/report_question/')}}",
                data: {reason: reason, other: other, question_id: reported_question_id},
                success: function (data) {
                    $('#report_modal .modal-body').html(data);
                }
            });
        });

        $('.question_text').click(function () {
            window.location.href = $(this).parent().parent().attr('href');
        });

        $('.upvote_question').click(function () {
            var question_id = $(this).attr('value');
            var type = 0;
            var question = $(this);
            $.ajax({
                'url': "{{url('')}}/vote/question/" + question_id + "/" + type,
                success: function (data) {
                    question.parent().find('.question_votes').html(data);
                }
            });
        });

        $('.downvote_question').click(function () {
            var question_id = $(this).attr('value');
            var type = 1;
            var question = $(this);
            $.ajax({
                'url': "{{url('')}}/vote/question/" + question_id + "/" + type,
                success: function (data) {
                    question.parent().find('.question_votes').html(data);
                }
            });
        });
    </script>

@endsection
