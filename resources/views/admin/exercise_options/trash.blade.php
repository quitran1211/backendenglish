@extends('admin.layouts.app')

@section('title', 'Thùng rác đáp án')

@section('content')
    <div class="container-fluid p-4">

        <div class="rounded border bg-white shadow-sm overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="px-4 py-3">Nội dung</th>
                            <th class="px-4 py-3 text-center">Khôi phục</th>
                            <th class="px-4 py-3 text-center">Xóa vĩnh viễn</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($list as $item)
                            <tr>
                                <td class="px-4 py-3">{{ $item->option_text }}</td>

                                <td class="px-4 py-3 text-center">
                                    <form action="{{ route('exercise.options.restore', [$exercise->id, $item->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-success btn-sm">Khôi phục</button>
                                    </form>
                                </td>

                                <td class="px-4 py-3 text-center">
                                    <form action="{{ route('exercise.options.forceDelete', [$exercise->id, $item->id]) }}"
                                        method="POST" onsubmit="return confirm('Xóa vĩnh viễn?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-4">
                                    Thùng rác trống
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
