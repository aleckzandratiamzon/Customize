@extends('layouts.app2')

@section('contents')
    @if(session('status'))
        <script>
            Swal.fire({
                title: 'Success!',
                text: "{{ session('status') }}",
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
    <!-- Breadcrumb section start -->
    <section class="breadcrumb-section section-b-space">
        <ul class="circles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3>User Dashboard</h3>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="index.php">
                                    <i class="fas fa-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">User Dashboard</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb section end -->

    <!-- user dashboard section start -->
    <section class="section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <ul class="nav nav-tabs custome-nav-tabs flex-column category-option" id="myTab">
                        <li class="nav-item mb-2">
                            <button class="nav-link font-light active" id="tab" data-bs-toggle="tab" data-bs-target="#dash" type="button"><i class="fas fa-angle-right"></i>Dashboard</button>
                        </li>

                        <li class="nav-item mb-2">
                            <button class="nav-link font-light" id="1-tab" data-bs-toggle="tab" data-bs-target="#order" type="button"><i class="fas fa-angle-right"></i>Orders</button>
                        </li>

                        <li class="nav-item mb-2">
                            <button class="nav-link font-light" id="5-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"><i class="fas fa-angle-right"></i>Profile</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link font-light" id="6-tab" data-bs-toggle="tab" data-bs-target="#security" type="button"><i class="fas fa-angle-right"></i>Security</button>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-9">
                    <div class="filter-button dash-filter dashboard">
                        <button class="btn btn-solid-default btn-sm fw-bold filter-btn">Show Menu</button>
                    </div>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="dash">
                            <div class="dashboard-right">
                                <div class="dashboard">
                                    <div class="page-title title title1 title-effect">
                                        <h2>My Dashboard</h2>
                                    </div>
                                    <div class="welcome-msg">
                                        <h6 class="font-light">Hello, <span class="text-uppercase">{{ auth()->user()->name }} !</span></h6>
                                    </div>

                                    <div class="order-box-contain my-4">
                                        <div class="row g-4">
                                            <div class="col-lg-4 col-sm-6">
                                                <div class="order-box">
                                                    <div class="order-box-image">
                                                        <img src="assets/images/svg/box.png" class="img-fluid blur-up lazyload" alt="">
                                                    </div>
                                                    <div class="order-box-contain">
                                                        <img src="assets/images/svg/box1.png" class="img-fluid blur-up lazyload" alt="">
                                                        <div>
                                                            <h5 class="font-light">total order</h5>
                                                            <h3>{{$orderCount}}</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-sm-6">
                                                <div class="order-box">
                                                    <div class="order-box-image">
                                                        <img src="assets/images/svg/sent.png" class="img-fluid blur-up lazyload" alt="">
                                                    </div>
                                                    <div class="order-box-contain">
                                                        <img src="assets/images/svg/sent1.png" class="img-fluid blur-up lazyload" alt="">
                                                        <div>
                                                            <h5 class="font-light">pending orders</h5>
                                                            <h3>{{$orderPendingCount}}</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="box-account box-info">
                                        {{-- <div class="box-head">
                                            <h3>Account Information</h3>
                                        </div> --}}
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="box">
                                                    <div class="box-title">
                                                        <h4>Contact Information</h4>
                                                        {{-- <a href="javascript:void(0)">Edit</a> --}}
                                                    </div>
                                                    <div class="box-content">
                                                        <h6 class="font-light">{{ auth()->user()->name }}</h6>
                                                        <h6 class="font-light">{{ auth()->user()->email }}</h6>
                                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#changePasswordModal">Change Password</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade table-dashboard dashboard wish-list-section" id="order">
                            <div class="box-head mb-3">
                                <h3 class="text-lg">My Order</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table cart-table">
                                    <thead>
                                        <tr class="table-head">
                                            <th scope="col">image</th>
                                            <th scope="col">Product Details</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order as $item)
                                        <tr>
                                            <td>
                                                <a href="details.php">
                                                    <img src="{{ asset($item->image) }}" class="blur-up lazyloaded" alt="{{ $item->product_title }}">
                                                </a>
                                            </td>


                                            <td>
                                                <p class="fs-6 m-0">{{$item->product_title}}</p>
                                            </td>
                                            <td>
                                                <p class="btn btn-sm
                                                    {{ $item->delivery_status === 'Pending' ? 'btn-warning' : ($item->delivery_status === 'Delivered' ? 'btn-success' : 'btn-primary') }} rounded-pill">
                                                    {{ $item->delivery_status }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="theme-color fs-6">&#8369;{{ $item->price }}</p>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade dashboard-profile dashboard" id="profile">
                            <div class="box-head">
                                <h3>Profile</h3>
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#resetEmail">Edit</a>
                            </div>
                            <ul class="dash-profile">
                                <li>
                                    <div class="left">
                                        <h6 class="font-light">Full Name</h6>
                                    </div>
                                    <div class="right">
                                        <h6>{{ auth()->user()->name }}</h6>
                                    </div>
                                </li>

                                <li>
                                    <div class="left">
                                        <h6 class="font-light">Phone</h6>
                                    </div>
                                    <div class="right">
                                        <h6>{{ auth()->user()->phone }}</h6>
                                    </div>
                                </li>
                            </ul>

                            <div class="box-head mt-lg-5 mt-3">
                                <h3>Login Details</h3>
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#changePasswordModal">Change Password</a>
                            </div>

                            <ul class="dash-profile">
                                <li>
                                    <div class="left">
                                        <h6 class="font-light">Email Address</h6>
                                    </div>
                                    <div class="right">
                                        <h6>{{ auth()->user()->email }}</h6>
                                    </div>
                                </li>

                                <li class="mb-0">
                                    <div class="left">
                                        <h6 class="font-light">Password</h6>
                                    </div>
                                    <div class="right">
                                        <h6>●●●●●●</h6>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <!--Change Password Modal -->
                        <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title p-3 fs-4" id="changePasswordModalLabel"><b>Change Password</b></h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="changePassword" method="POST" action="{{ route('change.password') }}">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="current_password" class="form-label">Current Password</label>
                                                <input type="password" name="current_password" class="form-control" required id="current_password" maxlength="50">
                                                @if ($errors->has('current_password'))
                                                    <div class="text-danger">{{ $errors->first('current_password') }}</div>
                                                @endif
                                            </div>

                                            <div class="mb-3">
                                                <label for="new_password" class="form-label">New Password</label>
                                                <input type="password" name="new_password" class="form-control" required id="new_password" maxlength="50">
                                                @if ($errors->has('new_password'))
                                                    <div class="text-danger">{{ $errors->first('new_password') }}</div>
                                                @endif
                                            </div>

                                            <div class="mb-3">
                                                <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                                                <input type="password" name="new_password_confirmation" class="form-control" required id="new_password_confirmation" maxlength="50">
                                                @if ($errors->has('new_password_confirmation'))
                                                    <div class="text-danger">{{ $errors->first('new_password_confirmation') }}</div>
                                                @endif
                                            </div>

                                            <div class="flex items-center justify-start mb-3">
                                                <input type="checkbox" id="show-password" class="h-4 w-4">
                                                <label for="show-password" class="ml-2 text-sm text-gray-700">Show Password</label>
                                            </div>

                                            <button type="submit" id="submitButton" class="btn btn-primary rounded">
                                                Change Password
                                                <span id="loadingSpinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                                            </button>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal for Editing Profile -->
                        <div class="modal fade" id="resetEmail" tabindex="-1" aria-labelledby="resetEmailLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title p-3 fs-4" id="resetEmailLabel"><b>Edit Profile</b> </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        {{-- <form method="POST" action="{{ route('profile.update') }}">
                                            @csrf
                                            @method('PUT') <!-- Use PUT for updating resources --> --}}
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Full Name</label>
                                                <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Phone</label>
                                                <input type="text" name="phone" class="form-control" value="{{ auth()->user()->phone }}" required>
                                            </div>

                                            <button type="submit" class="btn btn-primary rounded">Save Changes</button>
                                        {{-- </form> --}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade dashboard-security dashboard" id="security">
                            <div class="box-head">
                                <h3>Delete Your Account</h3>
                            </div>
                            <div class="security-details">
                                <h5 class="font-light mt-3">Hi <span> {{ auth()->user()->name }},</span>
                                </h5>
                                <p class="font-light mt-1">We Are Sorry To Here You Would Like To Delete Your Account.
                                </p>
                            </div>

                            <div class="security-details-1 mb-0">
                                <div class="page-title">
                                    <h4 class="fw-bold">Note</h4>
                                </div>
                                <p class="font-light">Deleting your account will permanently remove your profile,
                                    personal settings, and all other associated information. Once your account is
                                    deleted, You will be logged out and will be unable to log back in.</p>

                                <p class="font-light mb-4">If you understand and agree to the above statement, and would
                                    still like to delete your account, than click below</p>
                                    <form id="deleteAccountForm" method="POST" action="{{ route('account.delete') }}">
                                        @csrf
                                        @method('DELETE') <!-- Use DELETE for deleting resources -->
                                        <button type="submit" class="btn btn-solid-default btn-sm fw-bold rounded">Delete Your Account</button>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- user dashboard section end -->

    <script>
        document.getElementById('show-password').addEventListener('change', function() {
            const passwordFields = [
                document.getElementById('current_password'),
                document.getElementById('new_password'),
                document.getElementById('new_password_confirmation')
            ];
            passwordFields.forEach(field => {
                field.type = this.checked ? 'text' : 'password';
            });
        });

        document.getElementById('changePassword').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Client-side validation
            const newPassword = document.getElementById('new_password').value;
            const newPasswordConfirm = document.getElementById('new_password_confirmation').value;

            if (newPassword !== newPasswordConfirm) {
                return Swal.fire({
                    title: 'Error!',
                    text: 'New passwords do not match.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }

            const formData = new FormData(this);
            const submitButton = document.getElementById('submitButton');
            const loadingSpinner = document.getElementById('loadingSpinner');

            submitButton.disabled = true;
            loadingSpinner.style.display = 'inline-block';

            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token
                }
            })
            .then(response => {
                // Re-enable the button and hide the loading spinner
                submitButton.disabled = false;
                loadingSpinner.style.display = 'none';
                if (!response.ok) {
                    return response.json().then(err => {
                        throw new Error(err.error);
                    });
                }
                return response.json();
            })
            .then(data => {
                Swal.fire({
                    title: 'Success!',
                    text: data.success,
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    location.reload(); // Reload the page after confirming
                });
            })
            .catch(error => {
                Swal.fire({
                    title: 'Error!',
                    text: error.message,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                submitButton.disabled = false; // Re-enable the button
                loadingSpinner.style.display = 'none'; // Hide the spinner
            });
        });


        //Deleting Account
        document.getElementById('deleteAccountForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!'
        }).then((result) => {
            if (result.isConfirmed) {
                const formData = new FormData(this);
                const submitButton = this.querySelector('button[type="submit"]');

                submitButton.disabled = true; // Disable the button to prevent multiple submissions

                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token
                    }
                })
                .then(response => {
                    submitButton.disabled = false; // Re-enable the button
                    if (!response.ok) {
                        return response.json().then(err => {
                            throw new Error(err.error);
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    Swal.fire({
                        title: 'Deleted!',
                        text: data.success,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        location.reload(); // Optionally reload the page after deletion
                    });
                })
                .catch(error => {
                    Swal.fire({
                        title: 'Error!',
                        text: error.message,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                    submitButton.disabled = false; // Re-enable the button
                });
            }
        });
    });
    </script>




@endsection
