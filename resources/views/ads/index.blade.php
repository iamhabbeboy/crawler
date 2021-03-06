@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Ads <a style="float: right; cursor: pointer;" data-toggle="modal" data-target="#addAd"><i class="material-icons">add</i></a></div>
                
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($ads as $ad)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $ad->name }}
                            <div>
                                <a href="/ads/{{ $ad->id }}/edit"><span class="badge badge-primary badge-pill"><i class="material-icons">edit</i></span></a>
                                <form action="/ads/{{ $ad->id }}" method="POST" id="delete-{{ $ad->id }}-ad">
                                    @method('DELETE')
                                    @csrf
                                </form>
                                <a href="" onclick="event.preventDefault();
                                                         document.getElementById('delete-{{ $ad->id }}-ad').submit();">
                                    <span class="badge badge-danger badge-pill"><i class="material-icons">close</i></span>
                                </a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('ads.index') }}">View More...</a>
                </div>
            </div>
            <br>
            {{ $ads->links() }}
        </div>
    </div>
</div>

<div class="modal fade" id="addLink" tabindex="-1" role="dialog" aria-labelledby="addLinkLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLinkLabel">New Link</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('pages.store') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Link:</label>
                        <input type="url" name="link" class="form-control{{ $errors->has('link') ? ' is-invalid' : '' }}" id="recipient-name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Link</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="addAd" tabindex="-1" role="dialog" aria-labelledby="addAdLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAdLabel">New Ad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('ads.store') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Name:</label>
                        <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="recipient-name" required>
                         @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="url" class="col-form-label">Link it redirects to</label>
                        <input type="url" name="url" class="form-control{{ $errors->has('url') ? ' is-invalid' : '' }}" id="url" required>
                         @if ($errors->has('url'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('url') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="file" class="col-form-label">Image</label>
                        <input type="file" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" id="file" name="image" required>
                         @if ($errors->has('image'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('image') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Ad</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
