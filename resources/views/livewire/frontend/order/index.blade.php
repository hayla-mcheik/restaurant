<div>
<div class="pt-2"></div>

@if (Session::has('success'))

<div class="alert alert-success text-center">

    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>

    <p>{{ Session::get('success') }}</p>

</div>

@endif
 <!-- Modal -->
 <div class="modal fade" id="add-address-modal" tabindex="-1" role="dialog" aria-labelledby="add-address" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="add-address">Add Delivery Address</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form method="post" action="{{ route('user.address.save') }}">
            @csrf
            <div class="form-row p-4">
                <div class="form-group col-md-6">
                    <label for="label">Label (e.g., Home, Work)</label>
                    <input type="text" class="form-control" name="label" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" name="address" placeholder="Complete Address e.g., house number, street name, landmark" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mx-4 mb-2">Add Address</button>
        </form>
        
      </div>
   </div>
</div>

@if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
@endif

@if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('error') }}
    </div>
@endif


<div class="bg-white rounded shadow-sm p-4 mb-4">
   <h4 class="mb-1">Choose a delivery address</h4>
<div class="row">
   <div class="col-12">
   <h6 class="mb-3 text-black-50 ">Multiple addresses in this location
     <a data-toggle="modal" data-target="#add-address-modal" class="btn btn-sm btn-primary mr-2 float-end " href="#"> ADD NEW ADDRESS</a> 
   </h6>
  
   </div>
  </div>
  

  <div class="row" id="addresses-container">

  
    @foreach(auth()->user()->addresses as $address)
    <div class="col-md-6">
        <div  id="addresses-card-{{ $address->id }}" class="address-card bg-white card addresses-item mb-4
            @if($selectedAddressId == $address->id) border-success @endif">
            <div class="gold-members p-4">
                <div class="media">
                    <div class="mr-3"><i class="icofont-briefcase icofont-3x"></i></div>
                    <div class="media-body">
                        <p>{{ $address->label }}</p>
                        <p>{{ $address->address }}</p>
                        <p class="mb-0 text-black font-weight-bold">
                            <button id="btn-address-{{ $address->id }}" 
                                class="address-button btn 
                                @if($selectedAddressId == $address->id) btn-success @else btn-secondary @endif"
                                wire:click="selectedAddress({{ $address->id }})">
                    Deliver Here
                        </button>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
</div>

</div>



<!-- Move this hidden input outside of the payment method tabs -->
<input type="hidden" name="selectedAddressId" id="selected-address-id" wire:model.defer="selectedAddressId">

<div class="pt-2"></div>
<div class="bg-white rounded shadow-sm p-4 osahan-payment">
   <h4 class="mb-1">Choose payment method</h4>
   <h6 class="mb-3 text-black-50">Credit/Debit Cards</h6>
   <div class="row">
      <div class="col-sm-4 pr-0">
         <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link" id="v-pills-cash-tab" data-toggle="pill" href="#v-pills-cash" role="tab" aria-controls="v-pills-cash" aria-selected="false"><i class="icofont-money"></i> Pay on Delivery</a>
            <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false"><i class="icofont-id-card"></i> Stripe</a>      
         </div>
      </div>
      <div class="col-sm-8 pl-0">
         <div class="tab-content h-100" id="v-pills-tabContent">
            <div class="tab-pane fade" id="v-pills-cash" role="tabpanel" aria-labelledby="v-pills-cash-tab">
               <h6 class="mb-3 mt-0 mb-3">Cash</h6>
               <p>Please keep exact change handy to help us serve you better</p>
               
               <hr>
                <button class="btn btn-success btn-block btn-lg" wire:click="codOrder">Place Order
                    <i class="icofont-long-arrow-right"></i>
                </button>
                
            </div>


            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
               <h6 class="mb-3 mt-0 mb-3">Payment Using Stripe</h6>
               <p>WE ACCEPT <span class="osahan-card">
                Stripe
                  </span>
               </p>


               @if (Session::has('success'))
               <div class="alert alert-success text-center">
                   <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                   <p>{{ Session::get('success') }}</p>
               </div>
           @endif

           <form id="checkout-form" method="post" action="{{ route('stripe.post') }}" wire:ignore>
            @csrf
            <input type="hidden" name="stripeToken" id="stripe-token-id" >
            <br>
            <div id="card-element" class="form-control" ></div>
            <button id="pay-btn" class="btn btn-success mt-3" type="button" style="margin-top: 20px; width: 100%; padding: 7px;" onclick="createToken()">PAY $10</button>
        </form>
        
    
              
            </div>

         </div>



      </div>
   </div>
</div>
</div>


@push('scripts')
<!-- Add this script in your Blade template -->
<script>
       document.getElementById('checkout-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default submission
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        document.getElementById('checkout-form').appendChild(document.createElement('input')).value = csrfToken;
        document.getElementById('checkout-form').submit(); // Submit with CSRF token
    });
function selectedAddress(event, addressId) {
    event.stopPropagation();
        // Remove 'btn-success' class and border from all buttons and cards
        var addressButtons = document.querySelectorAll('[id^="btn-address-"]');
        var addressCards = document.querySelectorAll('[id^="addresses-card-"]');      

        addressButtons.forEach(function (btn) {
            btn.classList.remove('btn-success');
            btn.classList.add('btn-secondary');
        });
        
        addressCards.forEach(function (card) {
            card.classList.remove('border-success');
        });

        // Add 'btn-success' class to the clicked button
        var selectedButton = document.getElementById('btn-address-' + addressId);
        selectedButton.classList.add('btn-success');
        selectedButton.classList.remove('btn-secondary');

        // Add border to the selected card
        var selectedCard = document.getElementById('addresses-card-' + addressId);
        selectedCard.classList.add('border-success');

        // Set the selected address id in the hidden input
        var selectedAddressIdInput = document.getElementById('selected-address-id');
        selectedAddressIdInput.value = addressId;
    }
</script>




<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript">
    var stripe = Stripe('{{ env('STRIPE_KEY') }}')
    var elements = stripe.elements();
    var cardElement = elements.create('card', { hidePostalCode: true });
cardElement.mount('#card-element');

    /*------------------------------------------
    --------------------------------------------
    Create Token Code
    --------------------------------------------
    --------------------------------------------*/
    function createToken() {
        document.getElementById("pay-btn").disabled = true;
        stripe.createToken(cardElement).then(function(result) {

            if (typeof result.error != 'undefined') {
                document.getElementById("pay-btn").disabled = false;
                alert(result.error.message);
            }

            /* creating token success */
            if (typeof result.token != 'undefined') {
                document.getElementById("stripe-token-id").value = result.token.id;
                document.getElementById('checkout-form').submit();
            }
        });
    }
</script>

     @endpush
     