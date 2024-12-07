<form action="{{ route('nilai.store') }}" method="POST">
    @csrf
    <div>
        <label for="user_id">Pilih User</label>
        <select name="user_id" id="user_id" required>
            <option value="">Pilih User</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="kehadiran">Kehadiran</label>
        <input type="text" name="kehadiran" id="kehadiran" required>
    </div>

    <div>
        <label for="kompetensi">Kompetensi</label>
        <input type="text" name="kompetensi" id="kompetensi" required>
    </div>

    <div>
        <label for="skill">Skill</label>
        <input type="text" name="skill" id="skill" required>
    </div>

    <div>
        <label for="status">Status</label>
        <input type="text" name="status" id="status" required>
    </div>

    <button type="submit">Simpan</button>
</form>
