<template>
  <div class="row">
    <div class="login-box">
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body login-card-body">
          <div class="login-logo">
            <img src="~/assets/images/logo.jpeg" height="200px">
          </div>
          <p v-if="error" class="login-box-msg red">
            <b-alert show variant="danger">
              {{ error }}
            </b-alert>
          </p>

          <form @submit.prevent="login">
            <div class="input-group mb-3">
              <input v-model="form.email" type="email" class="form-control" placeholder="Email">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope" />
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input v-model="form.password" type="password" class="form-control" placeholder="Password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock" />
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-8">
                <div class="icheck-primary">
                  <input id="remember" type="checkbox">
                  <label for="remember">
                    تذكرني
                  </label>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block" :loading="form.busy">
                  دخول
                </button>
              </div>
              <!-- /.col -->
            </div>
          </form>
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
  </div>
</template>

<script>
export default {
  layout: 'default',
  middleware: 'auth',
  auth: 'guest',
  head () {
    return { title: this.$t('login') }
  },
  data: () => ({
    form: {
      email: '',
      password: ''
    },
    error: '',
    remember: false
  }),
  methods: {
    async login () {
      try {
        await this.$auth.loginWith('local', { data: this.form })
        this.$router.push({ name: 'dashboard' })
      } catch (err) {
        this.error = 'من فضلك تحقق من بياناتك'
      }
    }
  }
}
</script>
