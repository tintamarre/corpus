<template>
  <div>
      <div v-if="!add_new">

        <a @click="add_new = !add_new"
        class="btn btn-outline-success btn-sm">
        <fa icon="plus"></fa>
      </a>

    </div>


    <div v-else>
      <hr>
      <label-add
      :page_url="text.collection.links.api_resources_labels"
      :labels="labels"
      :add_new="add_new"
      :text="text"
      />


  </div>

</div>

</template>

<style>

</style>

<script>

export default {
  props: ['labels', 'text'],

  data() {
    return {
      add_new: false,
    }
  },
}
</script>
