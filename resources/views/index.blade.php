@extends('welcome')

@section('content')
<div class="container">
    <h2 class="text-center mt-5">Currency Converter</h2>
    <form action="{{'/show'}}" method="POST">
        @csrf
        <div class="mt-5">
            <div class="mb-3">
                <label for="">Amount</label>
                <input type="text" value="{{@session('amount')}}" class="form-control" name="amount" placeholder="1.00">
            </div>
            <div class="form-floating mb-3 d-flex justify-content-center align-items-center">
                <select class="form-select" name="from" id="floatingFrom">
                    @foreach ($codes as $code => $value)
                    <option {{ $code == @session('from') || $code == 'USD' ? 'selected' : '' }}>
                        {{$code}}
                    </option>
                    @endforeach
                </select>
                <label for="floatingFrom">from</label>
            </div>
            <div class="form-floating mb-3 d-flex justify-content-center align-items-center">
                <select class="form-select" name="to" id="floatingTo">
                    @foreach ($codes as $code => $value)
                    <option {{ $code == @session('to') || $code == 'PKR' ? 'selected' : '' }}>
                        {{$code}} </option>
                    @endforeach
                </select>
                <label for="floatingTo">to</label>
            </div>
        </div>
        <button type="submit" class="btn btn-outline-primary mb-3">Convert</button>
    </form>
    @if (session('msg'))
    <h2 class="card p-3 text-center">
        {{session('msg')}}
    </h2>
    @elseif ($errors->any())
    @foreach ($errors->all() as $error)
    <div class="card p-3 text-center text-danger">
        {{$error}}
    </div>
    @endforeach
    @endif
</div>

@endsection