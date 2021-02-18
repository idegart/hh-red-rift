@extends('layouts.site')

@section('container')

    <div class="row mt-3">
        <div class="col-12">
            <form action="{{ route('documents.store') }}" method="post">
                @csrf
                <button class="btn btn-primary">Добавить</button>
            </form>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Статус</th>
                    <th scope="col">Дата создания</th>
                    <th scope="col">Actor</th>
                    <th scope="col">Meta</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($documents as $document)
                    <tr>
                        <th scope="row">
                            <a href="{{ route('documents.show', compact('document')) }}">
                                {{ $loop->index }}
                            </a>
                        </th>
                        <td>
                            <x-document.status :document="$document"/>
                        </td>
                        <td>{{ $document->created_at->diffForHumans(now()) }}</td>
                        <td>{{ optional($document->payload)->actor }}</td>
                        <td>
                            @if($document->payload && $document->payload->meta)
                                <ul>
                                    <li><b>Type:</b> {{ $document->payload->meta->type }}</li>
                                    <li><b>Color:</b> {{ $document->payload->meta->color }}</li>
                                </ul>
                            @endif
                        </td>
                        <td>
                            @if($document->payload && $document->payload->actions)
                                <ul>
                                @foreach($document->payload->actions as $action)
                                    <li>
                                        <ul>
                                            <li><b>Action:</b> {{ $action->action }}</li>
                                            <li><b>Actor:</b> {{ $action->action }}</li>
                                        </ul>
                                    </li>
                                @endforeach
                                </ul>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection