@extends('admin.layouts.app')

@section('content')
<div class="app-content content ">
     <div class="content-overlay"></div>
     <div class="header-navbar-shadow"></div>
     <div class="content-wrapper container p-0">
         <div class="content-body">
             <section class="simple-validation">
                 <div class="row">
                     <div class="col-md-12">
                         <div class="card">
                             <div class="card-header">
                                 <h4 class="card-title">Create New Data</h4>
                             </div>
                             <div class="card-content">
                                 <div class="card-body">
                                     <form class="form-horizontal" novalidate action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                                         @csrf
                                         <div class="row">
                                             <div class="col-12 mt-1">
                                                 <div class="form-group">
                                                     <div class="controls">
                                                         <label for="name">Name</label>
                                                         <input type="text" name="name" class="form-control" placeholder="User Name" required data-validation-required-message="This Detail Location field is required">
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                         <button type="submit" class="btn btn-primary mt-1">Submit</button>
                                     </form>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </section>
         </div>
     </div>
 </div> 
@endsection