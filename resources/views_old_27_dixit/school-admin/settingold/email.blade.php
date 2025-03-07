<x-layout.default>
    <div class="relative flex min-h-screen items-center justify-center bg-[url(/assets/images/auth/map.png)] bg-cover bg-center bg-no-repeat px-6 py-10 dark:bg-[#060818] sm:px-16">
        
    <div class="panel shadow-lg rounded-lg p-8 max-w-6xl mx-auto " style="border-color: #a8acaf; border-width: medium;">
        <div class="flex justify-center mb-4">
            <h1 class="text-2xl font-bold">Email Setup</h1>
        </div>
        <form>            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div>
                    <label for="driver"><strong>Mail Driver</strong></label>
                    <input id="driver" type="text" style="width: 100%" placeholder="driver" class="form-input" required/>
                </div>
                <div>
                    <label for="host"><strong>Mail Host</strong></label>
                    <input id="host" type="text" name="host" placeholder="host" class="form-input" required/>
                </div>
                <div>
                    <label for="port"><strong>Mail Port</strong></label>
                    <input id="port" name="port" type="text" placeholder="port" class="form-input" required/>
                </div>
            </div>             
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label for="name"><strong>Mail Username</strong></label>
                    <input id="name" type="text" name="name" placeholder="name" class="form-input" required/>
                </div>
                <div>
                    <label for="psw"><strong>Mail Password</strong></label>
                    <input id="psw" name="psw" type="number" placeholder="psw" class="form-input" required />
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label for="encryption"><strong>Mail Encryption</strong></label>
                    <input id="encryption" name="encryption" type="text" placeholder="Encryption" class="form-input" required/>
                </div>
                <div>
                    <label for="address"><strong>Mail From Address</strong></label>
                    <input id="address" name="address" type="text" placeholder="Address" class="form-input" required/>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label for="mailname"><strong>Mail From Name</strong></label>
                    <input id="mailname" type="text" name="mailname" placeholder="Name" class="form-input" required />
                </div>
                <div>
                    <label for="testemail"><strong>Send Test Email</strong></label>
                    <input id="testemail" name="testemail" type="text" placeholder="Test Email" class="form-input" required />
                </div>
            </div>                     
            <div>
                <button type="submit" class="btn btn-primary !mt-6">Submit</button>
            </div>
        </form>          
    </div>
    </div>
    
    </x-layout.default>
    
    