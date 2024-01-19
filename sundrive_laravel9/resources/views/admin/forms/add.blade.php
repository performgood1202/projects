@extends('layouts.adminLayout')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Add form</h6>
                            <a href="{{route('forms')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
                        </div>
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-12">
                                    @if(session()->has('message'))
                                        <div class="pl-5 pr-5 pt-2">
                                                <div class="alert alert-success">
                                                    {{ session()->get('message') }}
                                                </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-lg-12">
                                    <div class="p-5">
                                        <form class="user" method="POST"  action="{{ route('postAddForm') }}">
                                            @csrf
                                            <div class="form-group row">
                                                <div class="col-sm-12 mb-3 mb-sm-0">
                                                    <input id="name" type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name">

                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                           
                                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                                Submit
                                            </button>
                                            <hr>
                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

</div>
@endsection

@push("js")
  <script type="text/javascript">
  </script>
@endpush