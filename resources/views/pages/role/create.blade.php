@extends('layouts.app', ['activePage' => 'roleCreate', 'titlePage' => __('Role Create')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="
							card-header card-header-primary
							d-flex
							justify-content-between
							py-1
						">
                        <h4 class="card-title m-0 pt-2">Role Create</h4>
                        <a href="{{route('role.index')}}" class="btn btn-info px-3">
                            <i class="fa fa-plus pr-1 font-weight-lighter"></i>
                            View Role List
                        </a>
                        <!-- <p class="card-category">Manage customer page</p> -->
                    </div>
                    <div class="card-body">

                        @if(session('message'))
                        <div class="alert alert-{{session('type')}}">{{session('message')}}</div>
                        @endif
                        <form action="{{route('role.store')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Role Name</label>
                                        <input type="text" class="form-control" name="name" value="{{old('name')}}">
                                        @error('name')<div class="text-danger">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>
                            <table class="table table-bordered">
                                <tr>
                                    <td colspan="2">
                                        <input type="checkbox" id="all" value="1">
                                        <label for="all">All</label>
                                    </td>
                                </tr>
                                @foreach ($group_name as $group)
                                <tr>
                                    <td>
                                        <input type="checkbox" id="{{$group}}" value="{{$group}}" onclick="selectGroup(this.id)">
                                        <label for="{{$group}}">{{$group}}</label>
                                    </td>
                                    <td class="{{$group}}">
                                        @foreach ($permissions as $item)
                                        @if($group == $item->group_name)
                                        <input type="checkbox" name="permissions[]" id="{{$item->name}}" value="{{ $item->id}}">
                                        <label for="{{$item->name}}">{{$item->name}}</label><br>
                                        @endif
                                        @endforeach
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
@push('js')
<script>
    $('#all').on('click', function() {
        if ($(this).is(':checked')) {
            $('input[type=checkbox').prop('checked', true);
        } else {
            $('input[type=checkbox').prop('checked', false);
        }
    })

    function selectGroup(className) {
        const checkbox = $('.' + className + ' input');
        console.log(checkbox);
        if ($('#' + className).is(':checked')) {
            checkbox.prop('checked', true);
        } else {
            checkbox.prop('checked', false);
        }
    }

</script>
@endpush
