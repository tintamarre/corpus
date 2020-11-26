<template>
  <div class="row" v-if="!data_fetched">
    <div class="col-md-12 text-center">

      <loading-animation />
    </div>

  </div>
  <div class="row" v-else>


    <div class="col-sm-12 col-md-12 col-lg-12">
      <div class="card">
        <div class="card-header">
          <fa icon="file"></fa>

          {{ fields.name }}

          <small class="pull-right">
            <fa icon="book"></fa>
          </small>

        </div>
        <div class="card-body">

          <div class="card-text">

            <text-component
            :text="fields"
            @reload-data="reloadData"
            />
          </div>

        </div>
      </div>
    </div>

  </div>
</template>

<style>

</style>

<script>
import GetDataMixin from '../../GetDataMixin';

export default {
  props: ['page_url'],
  mixins: [ GetDataMixin ],

  mounted() {
  },
  methods: {
    reloadData() {
      this.fetchData(this.page_url);
    }
  }


}
</script>
