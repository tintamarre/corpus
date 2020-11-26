<template>
  <div>

    <div v-if="error" class="alert alert-danger mt-3 alert-flash alert-dismissible fade show">
      Error {{ error.data }}
    </div>

    <div v-if="success" class="alert alert-success mt-3 alert-flash alert-dismissible fade show">
      {{ __('app.saved') }}
    </div>

  </div>
</template>


<script>

export default {
  props: ['error', 'success'],

  mounted() {
  },
  data() {
    return {
    }
  }
}
</script>
