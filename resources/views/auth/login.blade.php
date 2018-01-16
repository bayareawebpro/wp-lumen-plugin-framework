
<lumen-auth-login v-cloak="true" inline-template :auth_user="{{ json_encode($user) }}">
        <div class="vue-component">
            <div v-if="user.ID">
                Welcome back, @{{ user.display_name }}
            </div>
            <form v-else class="form-horizontal" v-on:submit.prevent="submitLogin">
                <div class="control-group" v-bind:class="{ 'has-error': errors.user_email }">
                    <label class="control-label" for="user_email">E-mail</label>
                    <div class="controls">
                        <input type="text" name="user_email" v-model="user.user_email" placeholder="" class="form-control">
                        <div class="help-block" v-if="errors">
                            <ul class="list-unstyled">
                                <li v-for="error in errors.user_email">
                                    @{{error}}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="control-group" v-bind:class="{ 'has-error': errors.user_pass }">
                    <label class="control-label" for="user_pass">Password</label>
                    <div class="controls" v-model="user">
                        <input type="password" name="user_pass" v-model="user.user_pass" placeholder="" class="form-control">
                        <div class="help-block" v-if="errors">
                            <ul class="list-unstyled">
                                <li v-for="error in errors.user_pass">
                                    @{{error}}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <button type="submit" class="btn btn-success" data-loading-text="Authenticating...">Login</button>
                    </div>
                </div>
            </form>
        </div>
</lumen-auth-login>