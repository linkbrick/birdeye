<div class="card">
    <div class="card-content">
        <table id="datatables" class="table table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%; word-break: break-all">
            <tbody>
            @foreach($user->notifications as $notification)
                <tr>
                    <td>
                        <a href="{{ route($notification->data['route_name'],['appointment' => $notification->data['appointment_id']]) }}">{{ $notification->data['title'] }}
                            <small>{{ $notification->data['body'] }}</small>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
