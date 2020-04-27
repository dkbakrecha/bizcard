<section class="content-header">
    <div class="row">
        <h1 class="pull-left">@yield('sectionTitle')</h1>
        <div class="pull-right user-right-pills">
            <span class="label label-primary">{{ __('messages.create') }}</span>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#categoryAdd">
                {{ __('messages.category') }}
            </button>
        </div>
    </div>
</section>


<!-- Category ADD Modal -->
<div class="modal fade" id="categoryAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{ __('messages.add_category') }}</h4>
            </div>
            <form action="{{ route('categories.store') }}" method="post"  id="categoryAddForm">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="alert alert-danger" style="display:none"></div>
                    @include('admin.categories.form')
                </div>
                <div class="modal-footer">
                    <button type="submit" id="categorySubmit" class="btn btn-primary">{{ __('messages.submit') }}</button>
                </div>    
            </form>

        </div>
    </div>
</div>