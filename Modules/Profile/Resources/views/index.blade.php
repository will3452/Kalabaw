<x-dashboard.layout>
    <x-page.title>Profile</x-page.title>
    <div class="profile-left">
        <!-- PROFILE HEADER -->
        <x-panel>
            <div style="justify-content: center; display:flex;align-items:center; flex-direction:column;">
                <img src="/no_user.png" class="img-circle" alt="Avatar" style="width:100px">
                <h3 class="name">{{auth()->user()->name}}</h3>
            </div>
            <h4 class="heading">Account Info</h4>
            <ul class="list-unstyled list-justify">
                <li>Account Type <span>{{auth()->user()->type}}</span></li>
                <li>Name <span>{{auth()->user()->name}}</span></li>
                <li>Email <span>{{auth()->user()->email}}</span></li>
                <li>Password <span><a href="#" onclick="changePassword()">change password</a></span></li>
                <li>Joined At <span>{{auth()->user()->created_at}}</span></li>
            </ul>
        </x-panel>
    </div>
    @push('head-script')
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    @endpush
    @push('body-script')
        <script>
            let password = '';
            function changePassword () {
                bootbox.prompt({
                    title: "Enter your new password",
                    inputType: 'password',
                    callback: function (result) {
                        password = result;
                        if (password) {
                            bootbox.prompt({
                                title:"Re-Type your new password",
                                inputType:'password',
                                callback: function (result) {
                                    if (result == null) {
                                        return;
                                    }
                                    if (password != result) {
                                        bootbox.alert('Your password isn\'t matched!');
                                        return;
                                    } else {
                                        axios.post('/api/profile/{{auth()->id()}}', {password:password})
                                            .then(res=> {
                                                if (res.data) {
                                                    bootbox.alert('Your password has been changed!')
                                                }
                                            })
                                            .catch(err=> {
                                                bootbox.alert(err)
                                            })
                                    }
                                }
                            })
                        }
                    }
                })
            }
        </script>
    @endpush
</x-dashboard.layout>
