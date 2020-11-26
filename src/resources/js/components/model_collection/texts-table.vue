<template>


  <div class="row">


    <div class="col-md-12 col-lg-12">


      <h2>{{ __('app.texts') }}
        <small>{{ textsData.length }}</small>
      </h2>

      <div class="table-responsive" id="texts">
        <table class="table table-sm table-hover">
          <thead>
            <tr>
              <th>{{ __('app.title') }}</th>
              <th class="text-right">{{ __('app.statistics') }}</th>
              <th class="text-center">{{ __('app.classification') }}</th>
              <th class="text-right"><fa icon="tag"></fa> {{ __('app.tags') }}</th>
              <th>{{ __('app.uploader') }}</th>
              <th>{{ __('app.updated_at') }}</th>
              <th></th>
            </tr>
          </thead>
          <!-- <tbody v-if="!data_fetched">
          <tr>
          <td colspan="6" class="text-center">
          <loading-animation></loading-animation>
        </td>
      </tr>
    </tbody> -->

    <tbody>





      <tr is="row-text" v-for="(text, index) in textsData.data" :key="text.id" :text="text"></tr>


    </tbody>
    <tfoot>
      <tr>
        <td class="text-right">

          <pagination :data="textsData" @pagination-change-page="getResults" :limit="6"></pagination>

        </td>

      </tr>
    </tfoot>

  </table>

</div>

</div>

</div>


</template>

<style scoped>

</style>

<script>
// import GetDataMixin from '../../GetDataMixin';


export default {
  props: ['page_url'],
  // mixins: [ GetDataMixin ],

  mounted() {
    // Fetch initial results
    this.getResults();
  },


  data() {
    return {
      // Our data object that holds the Laravel paginator data
      textsData: {},
    }
  },

  methods: {
    // Our method to GET results from a Laravel endpoint
    getResults(page = 1) {
      axios.get(this.page_url + '?page=' + page)
      .then(response => {
        this.textsData = response.data;
      });
    }
  }

}
</script>
