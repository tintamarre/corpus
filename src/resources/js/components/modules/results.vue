<template>
  <div>
    <h3>
      {{ __("app.results") }}
      <small class="text-muted">{{ results.result_count }}</small>
    </h3>

    <ul class="list-group list-group-flush">
      <li v-for="result in results.results" class="list-group-item">
        <span class="badge badge-pill badge-success">{{ result.type }}</span>
        <a :href="result.links.url_href">{{ result.links.url_name }}</a>
        <small>{{ result.description }}</small>
      </li>
    </ul>
  </div>
</template>

<style>
</style>

<script>
export default {
  props: ["results"],

  mounted() {},
  data() {
    return {};
  },
};
</script>
