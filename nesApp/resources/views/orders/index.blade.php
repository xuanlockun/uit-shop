
<x-app-layout>
    <div class="container">
        <h1>Bill checkout</h1>
        <form method="POST" action="{{ route('purchase') }}">
            @csrf

        @if ($orders->count() > 0)
            <table class="nes-table is-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        {{-- <th>Chi tiết</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->product->name }}</td>
                            {{-- <td>{{ $order->created_at->format('d/m/Y H:i:s') }}</td> --}}
                            <td>{{ $order->price }} USD</td> 
                            <td>{{ $order->quantity }}</td>
                            {{-- <td>{{ $order->status }}</td>  --}}
                            <td>
                                {{ $order->status }}
                                <input type="hidden" name="orders_id[]" value="{{ $order->id }}">
                                {{-- <a href="{{ route('orders.show', $order) }}" class="btn btn-primary">Xem chi tiết</a> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>You don't have any order.</p>
        @endif
    </div>
    <br><br>
    {{-- @foreach ( $receiver as $a )
        <p>{{ $a }}</p>
    @endforeach --}}
        {{-- <h3>Select a Receiver:</h3> --}}
    <div class="nes-container with-title is-centered">
        <p class="title">Select a Receiver:</p>
            
        <div>
            <label for="receiver_{{ $customer->id }}">
                <input type="radio" name="receiver_id" id="receiver_{{ $customer->id }}" value="default" class="nes-radio" checked>
                <span>{{ $customer->fullname }} - {{ $customer->phone }} - {{ $customer->address }}</span> 
            </label>
        </div>
        @foreach ($receiver as $rec)
            <div >
                <label for="receiver_{{ $rec->id }}">
                    <input type="radio" name="receiver_id" id="receiver_{{ $rec->id }}" value="{{ $rec->id }}"
                       data-fullname="{{ $rec->fullname }}" data-phone="{{ $rec->phone }}" data-address="{{ $rec->address }}" class="nes-radio">
                    <span>{{ $rec->fullname }} - {{ $rec->phone }} - {{ $rec->address }}</span>
                    <a href="/orders/{{ $rec->id }}" class="nes-btn is-error">Delete</a>
                </label>
            </div>
        @endforeach
        <input type="hidden" name="fullname" id="fullname">
        <input type="hidden" name="phone" id="phone">
        <input type="hidden" name="address" id="address">
        <button type="button" class="nes-btn is-primary" onclick="document.getElementById('dialog-default').showModal();">
            Add receiver
          </button>
    </div>
    <br>
        <button class="nes-btn is-primary" type="submit">Submit</button>
    </form>
    <dialog class="nes-dialog" id="dialog-default" style="width:500px;">
        <form method="POST" action="{{ route('receiver.store') }}">
            @csrf   
          <p class="title">Add new receiver</p>
          <label for="fullname">Fullname:</label>
          <input type="text" name="fullname" class="nes-input">
          <label for="phone">Phone:</label>
          <input type="text" name="phone" class="nes-input">
          <label for="address">Address:</label>
          <input type="text" name="address" class="nes-input">
          <menu class="dialog-menu">
            {{-- <button class="nes-btn">Cancel</button> --}}
            <button type="button" class="nes-btn" onclick="document.getElementById('dialog-default').close();">
                Cancel
              </button>
            <button type="submit" class="nes-btn is-primary">Confirm</button>
          </menu>
        </form>
      </dialog>
      <script>
        document.addEventListener('DOMContentLoaded', function () {
            const radios = document.querySelectorAll('input[name="receiver_id"]');
            const defaultFullname = @json($customer->fullname);
            const defaultPhone = @json($customer->phone);
            const defaultAddress = @json($customer->address);
    
            radios.forEach(radio => {
                radio.addEventListener('change', function () {
                    if (this.checked && this.value != 'default') {
                        document.getElementById('fullname').value = this.dataset.fullname;
                        document.getElementById('phone').value = this.dataset.phone;
                        document.getElementById('address').value = this.dataset.address;
                    } else {
                        document.getElementById('fullname').value = defaultFullname;
                        document.getElementById('phone').value = defaultPhone;
                        document.getElementById('address').value = defaultAddress;
                    }
                });
            });
    
            // Initialize hidden fields with default values
            const defaultRadio = document.querySelector('input[name="receiver_id"][value="default"]');
            if (defaultRadio && defaultRadio.checked) {
                document.getElementById('fullname').value = defaultFullname;
                document.getElementById('phone').value = defaultPhone;
                document.getElementById('address').value = defaultAddress;
            }
        });
    </script>
    
</x-app-layout>