<template>
    <div>
        <Card class="card-login container col-3">
            <div>
                <Label
                    color="#474554"
                    fontSize="16px"
                    fontWeight="400"
                    lineHeight="24px"
                    class="text-login"
                >
                    Login
                </Label>
            </div>
            <div>
                <Input
                    className="form-control nom"
                    placeholderName="e-mail"
                    typeInput="text"
                    v-model="user.username"
                    :class="{ 'is-invalid': usernameError }"
                />
                <div v-if=" usernameError && !user.username" class="invalid-feedback error">required.</div>
            </div>
            <div>
                <Input
                    className="form-control nom"
                    placeholderName="Password"
                    typeInput="password"
                    v-model="user.password"
                    :class="{ 'is-invalid': passwordError }"
                />
                <div v-if=" passwordError && !user.password" class="invalid-feedback error">required.</div>
            </div>
            <div>
                <Botton
                    label="Login"
                    class="btn btn-info login-button"
                    @click="login"
                >
                </Botton>
            </div>
            <div>
                <Label
                    color="#474554"
                    fontSize="16px"
                    fontWeight="400"
                    lineHeight="24px"
                    class="text-register"
                >
                    <a href="/register">Register</a>
                </Label>
            </div>
        </Card>
    </div>
</template>
<script>
    import Card from '@/components/atoms/card/Card.vue'
    import Input from '@/components/atoms/input/Input.vue'
    import Label from '@/components/atoms/label/Label.vue'
    import Botton from '@/components/atoms/button/Button.vue'
    import { accountService } from '@/service/account.service'
    
    export default {
        name: 'Login',
        components:{
            Card,Input,Label,Botton
        },
        data() {
            return {
                user: {
                    username:"",
                    password:""
                },
                passwordError: false,
                usernameError: false,
            }
        },
        methods: {
            login() {
                let that = this
                if(!this.user.password) {
                    this.passwordError = true;
                    return;
                }
                if(!this.user.username) {
                    this.usernameError = true;
                    return;
                }
                if(that.user.username && that.user.password){
                    accountService.login(this.user)
                        .then( res => {
                            this.$router.push('/personal')
                        })
                        .catch(err => 
                            console.log('error login', err)
                        )
                }else{
                    console.log('input obligatoire')
                }
            }
        }
    }
</script>
<style scoped>
.card-login {
    margin-top: 50px;
    text-align: center;
    border-radius: 4%;
    height: 400px;
}
.nom {
    margin-top: 5%;
}
.login-button {
    margin-top: 5%;
}
.text-login {
    margin-top: 5%;
    text-align: center;
}
.text-register {
    margin-left:24em; 
    text-decoration: none; 
}
.is-invalid {
    border: 1px solid red;
    }
</style>