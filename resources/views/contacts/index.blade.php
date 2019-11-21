@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Contacts</div>

                <div class="card-body">
                <div class="form-group row">
                <div class="col-md-6">
                          <a href="{{ route('contact.create')}}" > 
                            <button type="button" class="btn btn-primary float-left">New Contact</button>
                          </a>

                          @if ($message = Session::get('success'))
                            <div class="custom-alerts alert alert-success fade in">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                {!! $message !!}
                            </div>
                            <?php Session::forget('success');?>
                            @endif              
                 </div>  
                 </div>       
                   <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">father_name</th>
                            <th scope="col">address</th>
                            <th scope="col">cell</th>
                            <th scope="col">nic</th>
                            <th scope="col">districts</th>
                            <th scope="col">tehsil</th>
                            <th scope="col">us</th>
                            <th scope="col">Add by</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($contacts as $contact)
                            <tr>
                            <th scope="row">{{ $contact->id }}</th>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->father_name }}</td>
                            <td>{{ $contact->address }}</td>
                            <td>{{ $contact->cell }}</td>
                            <td>{{ $contact->cnic }}</td>
                            <td>{{ $contact->district }}</td>
                            <td>{{ $contact->tehsil }}</td>
                            <td>{{ $contact->uc }}</td>
                            <td><a href="admin/users/{{ $contact->user->id }}/edit">{{ $contact->user->name }}</a></td>
                            <td>
                            
                           

                           
                          <form action="" method="POST" class="float-left"> 
                          
                                <a href="{{ route('contact.edit', $contact->id) }}"> 
                                    <button type="button" class="btn btn-primary float-left">Edit</button>
                                </a>
                         
                           </form>

                           
                                <button type="submit" class="btn btn-danger" data-toggle="modal" data-url="{!! URL::route('post-delete', $contact->id) !!}" data-id="{{$contact->id}}" data-target="#custom-width-modal">Delete</button></a>
                                                                  
                           </form>
                          
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                        {{ $contacts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Delete Model -->
<form action="{{ route('contact.destroy', $contact) }}" method="POST" class="remove-record-model">
@csrf
                                {{ method_field('DELETE') }}
    <div id="custom-width-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="width:55%;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="custom-width-modalLabel">Delete Record</h4>
                </div>
                <div class="modal-body">
                    <h4>You Want You Sure Delete This Record?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger waves-effect waves-light">Delete</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection


