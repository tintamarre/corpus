<template>
  <div class="row">

    <div class="col-md-2 col-lg-2 col-sm-2 text-right text-muted">
      <h5>{{ __('app.classification') }}</h5>
    </div>

    <div class="col-sm-8 col-md-8 col-lg-8">

      <labels-edition-form-modal :labels="labels" :text="text" />

      <labels-div :labels="labels" />

    </div>

    <div class="col-sm-2 col-md-2 col-lg-2">
      <button class="btn btn-link btn-sm"
      data-toggle="modal"
      data-target="#TextLabelModal">
      <fa icon="edit"></fa>
      {{ __('app.edit') }}
    </button>
  </div>




</div>
</template>

<style scoped>

</style>

<script>

export default {
  props: ['labels', 'text'],
}
</script>
