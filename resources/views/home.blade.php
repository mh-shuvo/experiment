@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (isset($failures))
                       <div class="alert alert-danger" role="alert">
                          <strong>Errors:</strong>
                          
                          <ul>
                             @foreach ($failures as $failure)
                                @foreach ($failure->errors() as $error)
                                    <li>{{ $error }} on row number {{$failure->row()}}</li>
                                @endforeach
                             @endforeach
                          </ul>
                       </div>
                    @endif

                    <div class="row">

                        <div class="col-sm-8 offset-sm-2">

                            <div class="card-box">
                              <form action="{{route('csv-submit')}}" enctype="multipart/form-data"
                            method="POST">
                            @csrf
                                    <div class="form-group">
                                        <label class="col-form-label">CSV ফাইল নির্বাচন করুন:</label>
                                        <input class="form-control-file product_csv_file" type="file" name="product_csv_file" accept=".csv,.xlsx">
                                    </div>
                                    <hr>

                                    <center>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light"
                                        id="submit_btn"> <i class="fa fa-upload"></i> CSV আপলোড করুন</button>
                                    </center>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
