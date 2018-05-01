@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-14">

                <div class="panel panel-primary">
                    <div class="panel-heading text-center">خلاصه وضعیت صندوق</div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr class="bg-info">
                                    <th class="text-center">کل بدهی</th>
                                    <th class="text-center">بدهی قرض الحسنه ضروری</th>
                                    <th class="text-center">قرض الحسنه ضروری</th>
                                    <th class="text-center">بدهی قرض الحسنه عادی</th>
                                    <th class="text-center">قرض الحسنه عادی</th>
                                    <th class="text-center">موجودی صندوق</th>
                                    <th class="text-center">افزایش سرمایه</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-success">
                                    <th class="text-center">{{$all_payment_summary->loan_payments_p-$all_loan_summary->loans_p+$all_payment_summary->loan_payments_force_p-$all_loan_summary->loans_force_p}}</th>
                                    <th class="text-center">{{$all_payment_summary->loan_payments_force_p-$all_loan_summary->loans_force_p}}</th>
                                    <th class="text-center">{{$all_loan_summary->loans_force_p}}</th>
                                    <th class="text-center">{{$all_payment_summary->loan_payments_p-$all_loan_summary->loans_p}}</th>
                                    <th class="text-center">{{$all_loan_summary->loans_p}}</th>
                                    <th class="text-center">{{$all_payment_summary->payments_p-($all_payment_summary->loan_payments_p-$all_loan_summary->loans_p+$all_payment_summary->loan_payments_force_p-$all_loan_summary->loans_force_p)}}</th>
                                    <th class="text-center">{{$all_payment_summary->payments_p}}</th>
                                </tr>
                            </tbody>
                            <thead>
                            <tr class="bg-info">
                                <th class="text-center">کل بدهی</th>
                                <th class="text-center">بدهی قرض الحسنه ضروری</th>
                                <th class="text-center">قرض الحسنه ضروری</th>
                                <th class="text-center">بدهی قرض الحسنه عادی</th>
                                <th class="text-center">قرض الحسنه عادی</th>
                                <th class="text-center">هزینه های پرداختی</th>
                                <th class="text-center">افزایش سرمایه</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="bg-danger">
                                <th class="text-center">{{$all_payment_summary->loan_payments_np-$all_loan_summary->loans_np+$all_payment_summary->loan_payments_force_np-$all_loan_summary->loans_force_np}}</th>
                                <th class="text-center">{{$all_payment_summary->loan_payments_force_np-$all_loan_summary->loans_force_np}}</th>
                                <th class="text-center">{{$all_loan_summary->loans_force_np}}</th>
                                <th class="text-center">{{$all_payment_summary->loan_payments_np-$all_loan_summary->loans_np}}</th>
                                <th class="text-center">{{$all_loan_summary->loans_p}}</th>
                                <th class="text-center">{{$all_payment_summary->payments_cost_np}}</th>
                                <th class="text-center">{{$all_payment_summary->payments_np}}</th>

                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="panel panel-primary">
                    <div class="panel-heading text-center">
                        ( لیست کاربران
                        ( کاربران فعال
                        {{ $users->count() }}
                    </div>
                    <div class="panel-body bg-success">
                        <table class="table table-striped">
                            <thead>
                            <tr class="bg-info">
                                <th class="text-center">اصلاح کاربر</th>
                                <th class="text-center">دسترسی مدیریتی</th>
                                <th class="text-center">دسترسی بازرسی</th>
                                <th class="text-center">ارتباط با کاربر دیگر</th>
                                <th class="text-center">شماره حساب</th>
                                <th class="text-center">نام کاربری</th>
                                <th class="text-center">نام خانوادگی</th>
                                <th class="text-center">نام</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <th class="text-center">
                                        <a href="{{route('user_edit',['id' => $user->id])}}">
                                            <button type="button" class="btn btn-default">
                                                <span class="glyphicon glyphicon-cog" style="color:darkblue"></span>
                                            </button>
                                        </a>
                                    </th>
                                    <th class="text-center">
                                        @if ($user->is_super_admin==0)
                                            <span class="glyphicon glyphicon-remove" style="color:red"></span>
                                        @elseif ($user->is_super_admin==1)
                                            <span class="glyphicon glyphicon-ok" style="color:green"></span>
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if ($user->is_admin==0)
                                            <span class="glyphicon glyphicon-remove" style="color:red"></span>
                                        @elseif ($user->is_admin==1)
                                            <span class="glyphicon glyphicon-ok" style="color:green"></span>
                                        @endif
                                    </th>
                                    <th class="text-center">{{$user->relation}}</th>
                                    <th class="text-center">{{$user->acc_id}}</th>
                                    <th class="text-center">{{$user->username}}</th>
                                    <th class="text-center"><a href="{{ route('user',['id'=>$user->id]) }}">{{$user->l_name}}</a></th>
                                    <th class="text-center"><a href="{{ route('user',['id'=>$user->id]) }}">{{$user->f_name}}</a></th>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="text-center"> {{$users->links()}} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection