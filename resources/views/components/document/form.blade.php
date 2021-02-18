<form action="{{ route('documents.update', compact('document')) }}" method="post">
    @method('patch')
    @csrf

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <h3>Payload</h3>
            <div class="mb-3">
                <label for="payload_actor" class="form-label">Actor</label>
                <input name="payload[actor]" value="{{ optional($document->payload)->actor }}" class="form-control" id="payload_actor" placeholder="Payload actor">
            </div>
            <hr />
            <h3>Meta</h3>
            <div class="mb-3">
                <label for="meta_type" class="form-label">Type</label>
                <input name="payload[meta][type]" value="{{ optional(optional($document->payload)->meta)->type }}" class="form-control" id="meta_type" placeholder="Meta type">
            </div>
            <div class="mb-3">
                <label for="meta_color" class="form-label">Color</label>
                <input name="payload[meta][color]" value="{{ optional(optional($document->payload)->meta)->color }}" class="form-control" id="meta_color" placeholder="Meta color">
            </div>
        </div>
        <div class="col-md-6">
            <h3>Action #1</h3>
            <div class="mb-3">
                <label for="action_first_action" class="form-label">Action</label>
                <input name="payload[actions][0][action]" value="{{ optional(optional(optional($document->payload)->actions)->get(0))->action }}" class="form-control" id="action_first_action" placeholder="Action action">
            </div>
            <div class="mb-3">
                <label for="action_first_actor" class="form-label">Actor</label>
                <input name="payload[actions][0][actor]" value="{{ optional(optional(optional($document->payload)->actions)->get(0))->actor }}" class="form-control" id="action_first_actor" placeholder="Action actor">
            </div>
            <hr />
            <h3>Action #2</h3>
            <div class="mb-3">
                <label for="action_last_action" class="form-label">Action</label>
                <input name="payload[actions][1][action]" value="{{ optional(optional(optional($document->payload)->actions)->get(1))->action }}" class="form-control" id="action_last_action" placeholder="Action action">
            </div>
            <div class="mb-3">
                <label for="action_last_actor" class="form-label">Actor</label>
                <input name="payload[actions][1][actor]" value="{{ optional(optional(optional($document->payload)->actions)->get(1))->actor }}" class="form-control" id="action_last_actor" placeholder="Action actor">
            </div>
        </div>
    </div>

    @if($document->status === \App\Contracts\DocumentStatusContract::DRAFT)
        <button type="submit" class="btn btn-primary mt-3">Обновить</button>
    @endif
</form>