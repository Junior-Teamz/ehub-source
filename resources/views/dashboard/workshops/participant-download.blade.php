<table>
    <thead>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Nomor WhatsApp</th>
        <th>Tanggal Permintaan</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
        @foreach($participants as $key => $participant)
            <tr>
              <td>{{ $key + 1 }}</td>
              <td>{{ $participant->fullname ?? "-" }}</td>
              <td>{{ $participant->hasUser? $participant->hasUser->email ?? "-" : "-" }}</td>
              <td>{{ $participant->phone_number ?? "" }}</td>
              <td>{{ $participant->created_at ? format_date($participant->created_at, 'D MMMM Y') : '-'  }}</td>
              <td>{{ $participant->hasWorkshopParticipants->where('workshop_id', $workshop->id)->first()->statusLabel->value }}</td>
            </tr>
        @endforeach
    </tbody>
</table>