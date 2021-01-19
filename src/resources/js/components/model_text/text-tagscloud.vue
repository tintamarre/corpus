<template>
  <div class="row">
    <div class="col-md-2 col-lg-2 col-sm-2 text-right text-muted">
      <h5>{{ __("app.tagcloud") }}</h5>
    </div>

    <div class="col-sm-8 col-md-8 col-lg-8">
      <ul class="nav justify-content-center">
        <li v-for="item in tagscloud">
          <tag-span :item="item"></tag-span>
        </li>
      </ul>
    </div>

    <div class="col-sm-2 col-md-2 col-lg-2"></div>
  </div>
</template>

<style scoped>
ul {
  border: 1px solid #ccc;
  padding: 20px 0px 20px 0px;
  border-radius: 10px;
}
</style>

<script>
export default {
  props: ["tagscloud"],
};
</script>
