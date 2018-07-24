@extends('admin.layouts.default')
@section('heading')
<h1>Settings</h1>
<p>Simple flat-file JSON storage for key / value pairs.</p>
@endsection
@section('content')

<form method="post">
    <input type="hidden" name="action" value="add"/>
    <input type="hidden" name="_token" value="{{ wpLumen()->csrf() }}"/>
    <input type="text" name="key" placeholder="key"/>
    <input type="text" name="value" placeholder="value"/>
    <button type="submit" class="button button-primary">Save</button>
</form>
<br>
<table class="wp-list-table widefat striped">
    <thead>
    <tr>
        <th scope="col">Key</th>
        <th scope="col">Value</th>
        <th scope="col">Manage</th>
    </tr>
    </thead>
    <tbody>
    @foreach($settings->all() as $key => $value)
        <tr>
            <td class="column-primary">
                <code>{{ $key }}</code>
            </td>
            <td>
                <code>{{ $value }}</code>
            </td>
            <td>
                <form method="post" style="display: inline">
                    <input type="hidden" name="_token" value="{{ wpLumen()->csrf() }}"/>
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="key" value="{{ $key }}">
                    <input type="text" name="value" value="{{ $value }}" placeholder="value">
                    <button type="submit" class="button button-primary" onclick="confirm('Are you sure you want to update this setting?')">Update</button>
                </form>
                <form method="post" style="display: inline">
                    <input type="hidden" name="_token" value="{{ wpLumen()->csrf() }}"/>
                    <input type="hidden" name="key" value="{{ $key }}">
                    <input type="hidden" name="action" value="forget">
                    <button type="submit" class="button button-default" onclick="confirm('Are you sure you want to remove this setting?')">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@endsection