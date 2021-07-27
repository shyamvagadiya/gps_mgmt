@extends('layouts.main')
@section('title')
User Roles
@endsection
@section('content')

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  <div class="row">
    {{--  Roles Table--}}
    <div class="col-md-4">
      <div class="ribbon-wrapper card">
        <div class="ribbon ribbon-info">Roles</div>
        <div class="ribbon-content">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
              <tr>
                <th>Sr</th>
                <th>Name</th>
                {{-- <th>DiplayName</th> --}}
              </tr>
              </thead>
              <tbody>
              @isset($roles)
                @forelse ($roles as $role)
                  <tr>
                    <td> {{ $loop->iteration }}</td>
                    <td>
                        <span style="cursor: pointer">
                            <a href="{{ route('role.get', ['role_id' => $role->id ]) }}">
                                {{ $role->slug ?? $role->name }}
                            </a>
                        </span>
                    </td>
                    {{-- <td>{{ $role->slug }}</td> --}}
                  </tr>
                @empty
                  <p>No Roles</p>
                @endforelse
              @endisset

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    {{--  Permissions Table--}}
    <div class="col-md-8">


      <div class="card">
        @if(request('role_id') && $selected_role )
        <div class="row">
          <div class="col-md-12">
            <div class="card-title" style="padding: 15px"> {{ $selected_role->slug ?? $selected_role->name }} has Permissions</div>
            <hr>
            <div class="card-body">
              <form action="{{ route('role.assign_permission', [ 'role_id' => request('role_id') ]) }}" method="post" id="assign_permission_form">
                @csrf
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                    {{--<tr>
                      <th>View</th>
                      <th>Create</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>--}}
                    </thead>
                    <tbody>
                    @forelse ($permissions as $permission)
                      <td>
                        <input type="checkbox" class="chk-col-blue"
                               id="permission_checkbox_{{$permission->id}}"
                               name="permissions[{{$permission->name}}]"
                            {{ in_array($permission->name , $selected_role->getAllPermissions()->pluck('name')->toArray()) ? "checked":"" }}
                        >
                        <label for="permission_checkbox_{{$permission->id}}">
                          @if($permission->slug)

                          @php
                              $explode=explode('-',$permission->slug);
                              if($explode[0] == 'wallet')
                              {
                                  $explode[0]='gift_card';   
                              }
                              $getName=implode('-',$explode);
                          @endphp

                            {{$getName}}
                          @else

                            @php
                              $explode=explode('-',$permission->name);
                              if($explode[0] == 'wallet')
                              {
                                  $explode[0]='gift_card';   
                              }
                              $getName=implode('-',$explode);
                          @endphp
                            {{$getName}}
                          @endif
                        </label>
                      </td>
                      @if ( $loop->iteration % 4 == 0 )
                        <tr> @endif
                          @empty
                            <p> Role does not have any permissions yet </p>
                        @endforelse
                    </tbody>
                  </table>
                </div>
              </form>
            </div>
          </div>
        </div>
          <div class="row">
            <div class="col-md-4">
              <button type="button" style="margin-left: 29px;margin-bottom: 10px" onclick="event.preventDefault(); document.getElementById('assign_permission_form').submit();" class="btn btn-info waves-effect waves-light m-t-10"> Save</button> 
            </div>
          </div>
        @else
          <div class="ribbon ribbon-primary"> Permissions</div>
          <hr>
          <p>Please select any appropriate Role</p>
        @endif
      </div>
    </div>
  </div>
@endsection