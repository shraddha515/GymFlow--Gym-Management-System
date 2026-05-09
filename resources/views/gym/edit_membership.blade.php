@extends('admin.layout')

<style>
    .card-head {
       background: linear-gradient(90deg, #1a1a1a 0%, #2d2d2d 100%);

        /* Your Volt Green for the text and a bottom border */
        color: #ADCD25;
        border-bottom: 3px solid #ADCD25;

        /* Modern styling */
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 15px 20px;
        border-top-left-radius: 6px;
        border-top-right-radius: 6px;
        margin-bottom: 0;
}

    .btn.btn-cancel {
        background-color: transparent;
        color: #ef4444;
        border: 1px solid #ef4444;
        padding: 10px 18px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.25s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn.btn-cancel:hover {
        background-color: #ef4444;
        color: #fff;
        box-shadow: 0 4px 14px rgba(239, 68, 68, 0.2);
        transform: translateY(-1px);
    }

    .btn.btn-update {
        background: linear-gradient(45deg, #cdff00 0%, #799402 100%);
        color: #000;
        border: none;
        padding: 10px 18px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.25s ease;
        box-shadow: 0 4px 14px rgba(121, 148, 2, 0.18);
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn.btn-update:hover {
        filter: brightness(1.05);
        transform: translateY(-1px);
    }

    #membershipModal .form-control,
    #membershipModal .form-select,
    #membershipModal textarea {
        font-size: 0.83rem;
        border-radius: 6px;
        border: 1px solid #d1d5db;
        padding: 0.35rem 0.5rem;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .form-control:focus,
    .form-select:focus,
    textarea.form-control:focus,
    .glow-textarea:focus {
        border-color: #95b41c !important;
        box-shadow: 0 0 0 0.35rem rgba(205, 255, 0, 0.25) !important;
        outline: none !important;
    }
    </style>
@section('content')
    <div class="container mt-4">
        <div class="card mx-auto" style="max-width: 600px;"> <!-- Width limited for mobile -->
            <div class="card-head  ">
                
                <h5 class="mb-0">Edit Membership</h5>
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data" action="{{ route('membership.update', $membership->id) }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-12 col-md-8">
                            <label class="form-label">Membership Name *</label>
                            <input type="text" name="name" class="form-control" value="{{ $membership->name }}"
                                required>
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="form-label">Category *</label>
                            <select name="category_id" class="form-select">
                                <option value="">Select Category</option>
                                @foreach ($categories as $c)
                                    <option value="{{ $c->id }}"
                                        {{ $membership->category_id == $c->id ? 'selected' : '' }}>
                                        {{ $c->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-md-4">
                            <label class="form-label">Membership Period (days) *</label>
                            <input type="number" name="period_days" class="form-control"
                                value="{{ $membership->period_days }}" required>
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="form-label">Limit *</label>
                            <select name="limit_type" class="form-select">
                                <option value="Limited" {{ $membership->limit_type == 'Limited' ? 'selected' : '' }}>Limited
                                </option>
                                <option value="Unlimited" {{ $membership->limit_type == 'Unlimited' ? 'selected' : '' }}>
                                    Unlimited</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="form-label">Classes Count</label>
                            <input type="number" name="classes_count" class="form-control"
                                value="{{ $membership->classes_count }}">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label">Amount ($)</label>
                            <input type="text" name="amount" class="form-control" value="{{ $membership->amount }}">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label">Signup Fee ($)</label>
                            <input type="text" name="signup_fee" class="form-control"
                                value="{{ $membership->signup_fee }}">
                        </div>

                        <div class="col-12 col-md-8">
                            <label class="form-label">Installment Plan</label>
                            <select name="installment_id" class="form-select">
                                <option value="">Select Installment Plan</option>
                                @foreach ($installments as $ins)
                                    <option value="{{ $ins->id }}"
                                        {{ $membership->installment_id == $ins->id ? 'selected' : '' }}>
                                        {{ $ins->title }} - ${{ number_format($ins->amount, 2) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea name="description" rows="4" class="form-control">{{ $membership->description }}</textarea>
                        </div>

                        {{-- <div class="col-12">
                        <label class="form-label">Photo</label>
                        <input type="file" name="image" class="form-control">
                        @if ($membership->image)
                            <div class="mt-2 text-center">
                                <img src="{{ asset($membership->image) }}" width="120" class="img-fluid rounded">
                            </div>
                        @endif
                    </div> --}}
                    </div>

                    <div class="mt-3 d-flex justify-content-between flex-wrap">
                        <a href="{{ route('gym.membership') }}" class="btn me-2 mb-2 btn-cancel">Cancel</a>
                        <button type="submit" class="btn btn-update mb-2">Update Membership</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
