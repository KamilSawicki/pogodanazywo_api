<template>
  <div class="login">

    <div class="form">
      <span class="alert" v-show="credentialsError">Niepoprawny login lub hasło</span>
      <span class="alert" v-show="emailTypoError">Niepoprawny email</span>
      <span class="alert" v-show="passwordTypoError">Hasło musi zawierać minimum 8 znaków w tym jedną cyfrę</span>
      <span class="alert" v-show="confirmPasswordError && register">Hasła nie są identyczne</span>
      <input type="text" class="form-control email" placeholder="Adres email" @keyup.enter="submit()" v-model="email">
      <input type="password" class="form-control password" placeholder="Hasło" @keyup.enter="submit()"
             v-model="password">
      <transition name="custom-classes-transition" enter-active-class="animate__animated animate__fadeIn">
        <input type="password" class="form-control password" placeholder="Powtórz hasło" v-show="register"
               @keyup.enter="submit()" v-model="confirmPassword">
      </transition>
      <button class="btn" @click="submit()">{{ buttonText }}</button>
      <a class="join" v-show="!register" @click="register=!register">Nie posiadasz konta? Załóż nowe!</a>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: "Login",
  data: () => {
    return {
      register: false,
      errors: [],
      email: null,
      password: null,
      confirmPassword: null
    }
  },
  methods: {
    submit() {
      this.errors = []
      const target = this.register ? 'register' : 'login'
      axios.post(`api/auth/${target}`,
          {
            'email': this.email,
            'password': this.password
          })
          .then(response => {
            if (response.data.hasOwnProperty('errors'))
              this.errors = response.data.errors
            else {
                if(response.data === true){
                    this.$store.commit('setAuthenticated', true)
                    this.$store.commit('setEmail', this.email)
                    this.$router.push({name: 'Home'})
                }
            }
          })
    }
  },
  computed: {
    buttonText: function () {
      return this.register ? 'Zarejestruj' : 'Zaloguj'
    },
    credentialsError: function () {
      return this.errors.some(err => err === 'login_credentials_error')
    },
    passwordTypoError: function () {
      return this.errors.some(err => err === 'password_typo_error')
    },
    emailTypoError: function () {
      return this.errors.some(err => err === 'email_typo_error')
    },
    confirmPasswordError: function () {
      return this.confirmPassword !== this.password
    }
  }
}
</script>

<style scoped>
.login {
  display: flex;
  justify-content: center;
  align-items: center;
  height: calc(100vh - 70px);
}

.email {
  background-image: url('/images/email.svg');
  background-repeat: no-repeat;
  background-position: left center;
  background-size: 1.25em;
}

.password {
  background-image: url('/images/password.svg');
  background-repeat: no-repeat;
  background-position: left center;
  background-size: 1.25em;
}

.join {
  color: #999999;
  display: block;
  margin-top: 0.9rem;
  text-align: right;
}
</style>
