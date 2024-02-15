@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Vendor Details</h3>
                        <h6 class="font-weight-bold"><a href="{{ url('admin/admins/vendor') }}" class="btn btn-primary">Back</a></h6>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="justify-content-end d-flex">
                            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <i class="mdi mdi-calendar"></i> Today (10 Jan 2021)
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                                    <a class="dropdown-item" href="#">January - March</a>
                                    <a class="dropdown-item" href="#">March - June</a>
                                    <a class="dropdown-item" href="#">June - August</a>
                                    <a class="dropdown-item" href="#">August - November</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Personal Information</h4>

                      <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" value="{{ $vendorDetails['vendor_personal']['email'] }}" readonly="">
                      </div>
                      <div class="form-group">
                        <label for="vendor_name">Name</label>
                        <input type="text" class="form-control" value="{{ $vendorDetails['vendor_personal']['name'] }}"readonly="">
                      </div>
                      <div class="form-group">
                        <label for="vendor_address">Address</label>
                        <input type="text" class="form-control" value="{{ $vendorDetails['vendor_personal']['address'] }}" readonly="">
                      </div>
                      <div class="form-group">
                        <label for="vendor_city">City</label>
                        <input type="text" class="form-control" value="{{ $vendorDetails['vendor_personal']['city'] }}"readonly="">
                      </div>
                      <div class="form-group">
                        <label for="vendor_state">State</label>
                        <input type="text" class="form-control" value="{{ $vendorDetails['vendor_personal']['state'] }}"readonly="">
                      </div>
                      <div class="form-group">
                        <label for="vendor_country">Country</label>
                        <input type="text" class="form-control" value="{{ $vendorDetails['vendor_personal']['country'] }}"readonly="">
                      </div>
                      <div class="form-group">
                        <label for="vendor_zipcode">Zipcode</label>
                        <input type="text" class="form-control" value="{{ $vendorDetails['vendor_personal']['zipcode'] }}"readonly="">
                      </div>    
                      <div class="form-group">
                        <label for="vendor_mobile">Mobile</label>
                        <input type="text" class="form-control" value="{{ $vendorDetails['vendor_personal']['mobile'] }}"readonly="">
                      </div>
                      <div class="form-group">
                        <label>Created Date</label>
                        <input class="form-control" value="{{ $vendorDetails['vendor_personal']['created_at'] }}" readonly="">
                      </div>
                      <div class="form-group">
                        <label>Updated Date</label>
                        <input class="form-control" value="{{ $vendorDetails['vendor_personal']['updated_at'] }}" readonly="">
                      </div>
                      @if(!empty($vendorDetails['image']))
                      <div class="form-group">
                        <label for="vendor_image">Photo</label>
                        <br>
                            <img style="width: 200px;"src="{{ url ('admin/images/photos/'.$vendorDetails['image']) }}"></a>
                        @endif
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Business Information</h4>

                      <div class="form-group">
                        <label for="vendor_name">Shop Name</label>
                        <input type="text" class="form-control" @if(isset($vendorDetails['shop_name'])) value="{{ $vendorDetails['shop_name'] }}" required="" @endif readonly="">
                      </div>
                      <div class="form-group">
                        <label for="vendor_address">Shop Address</label>
                        <input type="text" class="form-control" @if(isset($vendorDetails['shop_address']))  value="{{ $vendorDetails['shop_address'] }}"required=""  @endif readonly="">
                      </div>
                      <div class="form-group">
                        <label for="vendor_city">Shop City</label>
                        <input type="text" class="form-control" @if(isset($vendorDetails['shop_city'])) value="{{ $vendorDetails['shop_city']}}"required=""  @endif readonly="">
                      </div>
                      <div class="form-group">
                        <label for="vendor_state">Shop State</label>
                        <input type="text" class="form-control" @if(isset($vendorDetails['shop_state'])) value="{{ $vendorDetails['shop_state']  }}"required=""  @endif readonly="">
                      </div>
                      <div class="form-group">
                        <label for="vendor_country">Shop Country</label>
                        <input type="text" class="form-control" @if(isset($vendorDetails['shop_country']) && $country['country_name'] == $vendorDetails['shop_country']) selected @endif readonly="">
                      </div>
                      <div class="form-group">
                        <label for="vendor_zipcode">Shop Zipcode</label>
                        <input type="text" class="form-control" @if(isset($vendorDetails['shop_zipcode'])) value="{{ $vendorDetails['shop_zipcode'] }}" required="" @endif readonly="">
                      </div>    
                      <div class="form-group">
                        <label for="vendor_mobile">Shop Mobile</label>
                        <input type="text" class="form-control" @if(isset($vendorDetails['shop_mobile'])) value="{{ $vendorDetails['shop_mobile'] }}" maxlength="11" minlength="11" required="" @endif readonly="">
                      </div>
                      <div class="form-group">
                        <label>Shop Website</label>
                        <input class="form-control" @if(isset($vendorDetails['shop_website'])) value="{{ $vendorDetails['shop_website']}}" required="" @endif  readonly="">
                      </div>
                      <div class="form-group">
                        <label>Shop Email</label>
                        <input class="form-control" @if(isset($vendorDetails['shop_email'])) value="{{ $vendorDetails['shop_email']}}" required="" @endif readonly="">
                      </div>
                      <div class="form-group">
                        <label>Business License Number</label>
                        <input class="form-control" @if(isset($vendorDetails['business_license_number'])) value="{{ $vendorDetails['business_license_number']}}" required="" @endif readonly="">
                      </div>
                      <div class="form-group">
                        <label>TIN Number</label>
                        <input class="form-control" @if(isset($vendorDetails['gst_number'])) value="{{ $vendorDetails['gst_number'] }}" required="" @endif readonly="">
                      </div>
                      <div class="form-group">
                        <label>CNS Number</label>
                        <input class="form-control" @if(isset($vendorDetails['pan_number'])) value="{{ $vendorDetails['pan_number'] }}" required="" @endif readonly="">
                      </div>
                      <div class="form-group">
                        <label>Address Proof</label>
                        <input class="form-control" @if(isset($vendorDetails['vendor_business']['address_proof'])) value="{{ $vendorDetails['vendor_business']['address_proof'] }}" required="" @endif readonly="">
                      </div>
                      <div class="form-group">
                        <label>Created Date</label>
                        <input class="form-control" value="{{ $vendorDetails['vendor_business']['created_at'] ?? '' }}" readonly="">
                      </div>
                      <div class="form-group">
                        <label>Updated Date</label>
                        <input class="form-control" value="{{ $vendorDetails['vendor_business']['created_at'] ?? ''}}" readonly="">
                      </div>
                      @if(!empty($vendorDetails['vendor_business']['address_proof_image']))
                      <div class="form-group">
                        <label for="vendor_image">Photo</label>
                        <br>
                            <img style="width: 200px;"src="{{ url ('admin/images/proofs/'.$vendorDetails['vendor_business']['address_proof_image']) }}"></a>
                        @endif
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Bank Information</h4>

                      <div class="form-group">
                        <label>Account Holder Name</label>
                        <input class="form-control" @if(isset($vendorDetails['account_holder_name'])) value="{{ $vendorDetails['account_holder_name'] }}"required="" @endif readonly="">
                      </div>
                      <div class="form-group">
                        <label for="vendor_name">Bank Name</label>
                        <input type="text" class="form-control" @if(isset($vendorDetails['bank_name'])) value="{{ $vendorDetails['bank_name']  }}"required="" @endif readonly="">
                      </div>
                      <div class="form-group">
                        <label for="vendor_address">Account Number</label>
                        <input type="text" class="form-control" @if(isset($vendorDetails['account_number'])) value="{{ $vendorDetails['account_number']  }}"required="" minlength='12' maxlength='12' @endif readonly="">
                      </div>
                      <div class="form-group">
                        <label for="vendor_city">Bank Code</label>
                        <input type="text" class="form-control" @if(isset($vendorDetails['bank_ifsc_code'])) value="{{ $vendorDetails['bank_ifsc_code']  }}"required="" @endif readonly="">
                      </div>
                      <div class="form-group">
                        <label>Created Date</label>
                        <input class="form-control" value="{{ $vendorDetails['vendor_bank']['created_at'] ?? ''}}" readonly="">
                      </div>
                      <div class="form-group">
                        <label>Updated Date</label>
                        <input class="form-control" value="{{ $vendorDetails['vendor_bank']['updated_at'] ?? ''}}" readonly="">
                      </div>
                    </form>
                  </div>
                </div>
              </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    @include('admin.layout.footer')
    <!-- partial -->
</div>

@endsection