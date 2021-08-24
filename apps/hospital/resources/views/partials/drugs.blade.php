<section class="mt-3">
    <p>
        Drugs for reference:
    </p>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
        </tr>
        </thead>
        <tbody>
        @foreach($drugs as $drug)
            <tr>
                <th scope="row">{{$drug->id}}</th>
                <td>{{$drug->name}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div >
        {{$drugs->links()}}
    </div>
</section>
