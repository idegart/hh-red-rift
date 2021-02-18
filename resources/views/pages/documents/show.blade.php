@extends('layouts.site')

@section('container')

    <div class="row justify-content-center mt-3">
        <div class="col-md-6">

            <div>
                <x-document.status :document="$document" />
            </div>

            <div class="mt-3">
                <x-document.form :document="$document" />
            </div>

            @if($document->status === \App\Contracts\DocumentStatusContract::DRAFT)
                <form method="post" action="{{ route('v1.document.publish', compact('document')) }}">
                    <button type="submit" class="btn btn-success mt-3">Опубликовать</button>
                </form>
            @endif
        </div>
    </div>
@endsection