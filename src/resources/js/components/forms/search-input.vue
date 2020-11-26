<template>
  <form :action="'/search/' + query" method="get">

    <input
    class="form-control"
    type="text"
    placeholder="Search"
    aria-label="Search"
    v-model="query"
    >

    <button
    v-if="query != null"
    class="btn btn-primary pull-right"
    type="submit">
    {{ __('app.search') }}
    <fa icon="search"></fa>
  </button>


</form>
</template>

<style>

</style>

<script>

export default {
  props: ['query'],

  mounted() {
  },
  data() {
    return {
      query: ''
    }
  }
}
</script>
