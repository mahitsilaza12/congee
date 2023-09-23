<template>
    <div>
        <Card class="card-register container col-3">
            <div>
                <Label
                    color="#474554"
                    fontSize="16px"
                    fontWeight="400"
                    lineHeight="24px"
                    class="text-register"
                >
                    Register
                </Label>
            </div>
            <div>
                <Input
                    className="form-control nom"
                    placeholderName="Nom"
                    typeInput="text"
                    v-model="user.nom"
                    :class="{ 'is-invalid': nomError }"
                />
                <div v-if="nomError && !user.nom" class="invalid-feedback error">required.</div>
            </div>
            <div>
                <Input
                    className="form-control nom"
                    placeholderName="prenom"
                    typeInput="text"
                    v-model="user.prenom"
                    :class="{ 'is-invalid': prenomError }"
                />
                <div v-if="prenomError && !user.prenom" class="invalid-feedback error">required.</div>

            </div>
            <div>
                <Input
                    className="form-control nom"
                    placeholderName="Numero"
                    typeInput="number"
                    v-model="user.phone"
                    :class="{ 'is-invalid':phoneError }"
                />
                <div v-if="phoneError && !user.phone" class="invalid-feedback error">required.</div>

            </div>
            <div>
                <Input
                    className="form-control nom"
                    placeholderName="e-mail"
                    typeInput="text"
                    v-model="user.email"
                    :class="{ 'is-invalid': emailError }"
                />
                <div v-if="emailError && !user.email" class="invalid-feedback error">required.</div>
            </div>
            <div>
                <Input
                    className="form-control nom"
                    placeholderName="Password"
                    typeInput="password"
                    v-model="user.password"
                    :class="{ 'is-invalid': passwordError }"
                />
                <div v-if="passwordError && !user.password" class="invalid-feedback error">required.</div>
            </div>
            <div>
                <Botton
                    label="save"
                    class="btn btn-info register-button"
                    @click="register"
                >
                </Botton>
            </div>
            <div>
                <Label
                    color="#474554"
                    fontSize="16px"
                    fontWeight="400"
                    lineHeight="24px"
                    class="text-login"
                >
                    <a href="/login">Login</a>
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
    import { accountService } from '@/service'
    export default {
        name: 'Register',
        components:{
            Card,Input,Label,Botton
        },
        data() {
            return {
                user: {},
                nomError:false,
                prenomError:false,
                phoneError:false,
                emailError:false,
                passwordError:false,
            }
        },
        methods: {
            register() {
                let that = this
                if(!this.user.nom) {
                    this.nomError = true;
                    return;
                }
                if(!this.user.prenom) {
                    this.prenomError = true;
                    return;
                }
                if(!this.user.phone) {
                    this.phoneError = true;
                    return;
                }
                if(!this.user.email) {
                    this.emailError = true;
                    return;
                }
                if(!this.user.password) {
                    this.passwordError = true;
                    return;
                }
                if(that.user){
                    accountService.register(that.user).then(
                        () => {
                            this.$router.push('/login');
                            },
                            error => {
                            this.$router.push('/register');
                                console.log(error.message, error.response && error.response.data)
                            }
                    ).catch(error => {
                        console.log('eto', error)
                        this.$router.push('/register');

                    })
                }else{
                    console.log('input obligatoire')
                    this.$router.push('/register');

                }
            }
        }
    }
</script>
<style scoped>
.card-register {
    margin-top: 50px;
    text-align: center;
    border-radius: 4%;
    height: 500px;
}
.nom {
    margin-top: 5%;
}
.register-button {
    margin-top: 5%;
}
.text-register {
    margin-top: 5%;
    text-align: center;
}
.text-login {
    margin-left:24em;   
    text-decoration: none; 
}
.is-invalid {
    border: 1px solid red;
    }
</style>