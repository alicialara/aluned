<div class="col-md-12">
    <div class="row">

        <div class="panel panel-default">
            <div class="panel-heading">Bookmarks list</div>
            <div class="panel-body">
                <div class="col-md-12">
                    <a role="button" class="btn btn-info btn-block" title="Crear nuevo poll semanal" href="/bookmarks/create">New bookmark</a>
                </div>
                <div class="col-md-12" style="margin-top: 20px;">
                    <table class="table display" id="" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($bookmarks as $bookmark)
                            <tr>
                                <td><b>{{ $bookmark->title }}</b></td>
                                <td>{{ $bookmark->description }}</td>
                                <td><a href="{{ $bookmark->url }}" class="btn btn-success btn-block">Abrir</a> </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>
</div>
