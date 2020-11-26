<template>
  <div>
    <h3>{{ __('app.results') }} <small>{{ __('app.count') }}: {{ results.result_count }}</small></h3>

    <ul class="list-group list-group-flush">
      <li v-for="result in results.results" class="list-group-item">

        <span class="badge badge-pill badge-success pull-right">{{ result.type }}</span>

        <p>
          <a :href="result.links.url_href">{{ result.links.url_name }}</a> <small>{{ result.description }}</small>
        </p>

      </li>
    </ul>

  </div>
</template>

<style>

</style>

<script>

export default {
  props: ['results'],

  mounted() {
  },
  data() {
    return {
    }
  }
}
</script>
