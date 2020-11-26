<template>
  <div class="">

    <div class="row">
      <div class="col-sm-3 col-md-3 col-lg-3">
        <div
        v-if="snippetReady(segment.id)"
        :style="positionSnippet(snippet.start, snippet.end)"
        class="small text-muted">
        <tag-select
        :text="text"
        :snippet="snippet"
        v-on="$listeners"
        @add-new-segment-tag="addNewSegmentTag"
        />
        <br />
        « <em>{{ snippet.string }}</em> »
        <!-- {{ snippet.start }} ==> {{ snippet.end }} -->
      </div>

    </div>

    <div class="col-sm-7 col-md-7 col-lg-7">
      {{ segment.position }}
      <!-- <p>lines:{{ countLine }} chars:{{ countChar }} words:{{ countWord }}</p> -->
      <p class="card-text text-content"
      :id="'segment-div-' + segment.id" :data-segment_id="segment.id"
      @mouseup="selectSnippet"
      v-html="wrapContent"></p>
      <!-- UGLY fix -->
      <br><br><br>
    </div>
    <div class="col-sm-2 col-md-2 col-lg-2">
      <div v-for="(tag, index) in segment.tags"
      :key="tag.snippet.segment_tag_id"
      :style="positionSnippet(tag.snippet.snippet_start, tag.snippet.snippet_end)">
      <div class="btn-group">
        <button class="btn btn-sm btn-primary dropdown-toggle"
        :style="colorTag(tag.color)"
        data-toggle="dropdown"
        aria-expanded="false"
        @mouseover="wrapSnippet(tag.snippet.snippet_start, tag.snippet.snippet_end)"
        @mouseout="unwrapSnippet"
        >
        <fa icon="tag" />
        {{ tag.name }} <span class="caret"></span>
      </button>
      <div class="dropdown-menu dropdown-menu-right">
        <a class="dropdown-item" :href="tag.links.self">
          <fa icon="quote-right" />
          {{ __('app.quote_view') }}
        </a>
        <!-- <a class="dropdown-item" href="">
        <fa icon="align-left" />
        {{ __('app.contextual_view') }}
      </a> -->
      <a class="dropdown-item" v-if="tag.parent" :href="tag.parent.links.self">
        <fa icon="tag" />
        {{ __('app.parent_tag') }} « {{ tag.parent.name }} »
      </a>
      <div class="dropdown-divider">

      </div>
      <a class="dropdown-item" @click="deleteTag(tag, segment, index)">
        <fa icon="trash" />
        {{ __('app.remove') }}
      </a>


      <div class="dropdown-divider"></div>
      <h6 class="dropdown-header">
        <small class="text-muted" title="">
          <!-- {{ tag.snippet.snippet_start }} => {{ tag.snippet.snippet_end }} -->
          {{ __('app.created_by') }} {{ tag.snippet.author }}
        </small>
      </h6>
    </div>

  </div>


</div>
</div>
</div>

<div class="row">
  <div class="col-sm-3 col-md-3 col-lg-3">


  </div>
  <div class="col-sm-7 col-md-7 col-lg-7">

    <div v-if="confDeleteSegment">
      <div class="alert alert-warning" role="alert">
        {{ __('app.all_tags_of_this_segment_will_be_deleted') }}
      </div>
      <button
      @click="deleteSegment(segment, segment_index)"
      class="btn btn-danger btn-sm">
      <fa icon="trash"></fa>
      {{ __('app.yes_i_confirm') }}
    </button>

    <button
    v-if="confDeleteSegment"
    @click="confDeleteSegment = !confDeleteSegment"
    class="btn btn-outline-secondary btn-sm">
    <fa icon="times"></fa>
    {{ __('app.cancel') }}
  </button>
</div>

<div class="form-group" v-if="addSegment">

  <div
  class="alert alert-primary"
  role="alert"
  v-html="__('app.info_how_to_segment_text')">
</div>

<form class="" :action="text.links.store_segment" method="post">

  <input type="hidden" name="_token" id="csrf-token" :value="csrfToken" />
  <input type="hidden" name="position" :value="segment.position" />

  <textarea name="text" rows="20" cols="80" class="form-control">

  </textarea>

  <button type="submit" class="btn btn-success pull-right">
    <fa icon="save"></fa>
    {{ __('app.insert') }}
  </button>
</form>


</div>

<div class="" v-if="editSegment">
  <div class="alert alert-primary" role="alert">
    {{ __('app.caution_when_editing_a_segment') }}
  </div>
  <form class="" :action="segment.links.update" method="POST">
    <input name="_method" type="hidden" value="PATCH">
    <input type="hidden" name="_token" id="csrf-token" :value="csrfToken" />
    <input type="hidden" name="position" :value="segment.position" />
    <textarea name="text" :rows="30" cols="66" class="form-control" v-text="segment.content">
    </textarea>


    <div class="pull-right">
      <button
      @click="editSegment = !editSegment"
      class="btn btn-secondary">
      <fa icon="times"></fa>
      {{ __('app.cancel') }}
    </button>

    <button type="submit" class="btn btn-success">
      <fa icon="save"></fa>
      {{ __('app.update') }}
    </button>
  </div>
</form>

</div>
</div>
<div class="col-sm-2 col-md-2 col-lg-2">
  <div class="small">

    <button
    v-if="!editSegment"
    @click="editSegment = !editSegment"
    class="btn btn-link btn-sm"
    v-tooltip:top="__('app.edit') + ' ' + __('app.segment') + ' ' + __('app.above')"
    >
    <fa icon="edit"></fa>
  </button>




<button
v-if="!confDeleteSegment"
@click="confDeleteSegment = !confDeleteSegment"
class="btn btn-link btn-sm"
v-tooltip:top="__('app.delete') + ' ' + __('app.segment') + ' ' + __('app.above')"
>
<fa icon="trash"></fa>
</button>

<button
v-if="confDeleteSegment"
@click="confDeleteSegment = !confDeleteSegment"
class="btn btn-link btn-sm"
v-tooltip:top="__('app.delete') + ' ' + __('app.segment')"
>
<fa icon="times"></fa> {{ __('app.cancel') }}
</button>


<button
v-if="!addSegment"
@click="addSegment = !addSegment"
class="btn btn-link btn-sm"
v-tooltip:top="__('app.add_new') + ' ' + __('app.segment') + ' ' + __('app.below')">
<fa icon="plus"></fa>
</button>

<button
v-if="addSegment"
@click="addSegment = !addSegment"
class="btn btn-link btn-sm">
<fa icon="times"></fa> {{ __('app.cancel') }}
</button>

</div>

</div>
</div>


</div>
</template>

<style scoped>

/* .data {
  color: red;
  background-color: yellow;
} */

</style>

<script>


import FormMixin from '../../FormMixin';

export default {
  mixins: [ FormMixin ],
  props: ['segment', 'text', 'segment_index'],
  data() {
    return {
      'snippet_start': null,
      'snippet_end': null,
      'snippet': {
        'start': null,
        'end': null,
        'string': null,
        'selected': false,
        'segment_id': null
      },
      'fields': {},
      'action': '',
      'confDeleteSegment': false,
      'editSegment': false,
      'addSegment': false,
      'csrfToken': "",
      'height': null,
    }
  },
  mounted() {
    this.csrfToken = document.querySelector('meta[name="csrf-token"]').content;
  },
  created() {


  },
  computed: {
    wrapContent() {
      return this.segment.content.substring(0,this.snippet_start) +
      "<span class='bg-warning'>" +
      this.segment.content.substring(this.snippet_start, this.snippet_end) +
      "</span>" +
      this.segment.content.substring(this.snippet_end);
    },
    // unwrapContent() {
    //   return this.segment.content;
    // },
    countLine() {
      return this.segment.content.split(/\r\n|\r|\n/).length;
    },
    countChar() {
      return this.segment.content.length;
    },
    countWord() {
      return this.segment.content.split(' ').length;
    },
    countPx() {
      // return line * px of line
    },
  },
  methods: {
    segmentHeight() {
      this.height = this.$refs.segmentDiv.clientHeight;
    },
    // countLines() {
    //    var el = document.getElementById('segment-div-' + this.segment.id);
    //    var divHeight = el.offsetHeight
    //    var lineHeight = parseInt(el.style.lineHeight);
    //    var lines = divHeight / lineHeight;
    //    console.log(lines);
    //    alert("Lines: " + lines);
    // },

    // 1. get height of element.
    // 2. get line height.
    // 3. divide 1 by 2 to figure out computed lines.
    countLines(element) {

      let x = $(element).prop('scrollHeight');
      let y = $(element).css('lineHeight');
      y = parseInt(y);

      return x/y;
    },
    snippetReady(segment_id){
      if(this.snippet.selected && segment_id == this.snippet.segment_id) {
        return true;
      }
    },
    selectSnippet(e) {
      this.snippet.selected = false;
      var snippet_start = window.getSelection().anchorOffset;
      var snippet_end = window.getSelection().focusOffset;
      if (snippet_start > snippet_end) {
        // Switch values if selection begin from below
        [snippet_start, snippet_end] = [snippet_end, snippet_start];
      }
      var element = event.target;
      if (
        ((snippet_end - snippet_start) > 0)
        && (snippet_end > 1)
      ) {
        this.snippet.selected = true;
        this.snippet.segment_id = element.getAttribute('data-segment_id');
        this.snippet.start = snippet_start;
        this.snippet.end = snippet_end;
        this.snippet.string = window.getSelection().toString();
      } else {
        this.snippet.selected = false;
        this.snippet.segment_id = null;
        this.snippet.start = null;
        this.snippet.end = null;
        this.snippet.string = null;
      }

    },
    onlyMyTags() {
      console.log('onlyMyTags');
    },
    positionSnippet(start, end) {
      var avg = Math.round((start + end) / 2);
      var content = this.segment.content.substring(0,avg);
      var paragraphs = content.split(/\r\n|\r|\n/);
      var parag_lines = 0;
      paragraphs.forEach((paragraph, i) => {
        parag_lines = parag_lines + Math.floor(paragraph.length / 80)
      });
      var lines = paragraphs.length + parag_lines;
      return {
        position: 'absolute',
        // line-height: 25px;
        top: lines * 25 +'px',
      };
    },
    colorTag(color) {
      return {
        backgroundColor: color,
        borderColor: color
      };
    },

    deleteTag(tag, segment, index) {
      this.action = tag.snippet.links.api_destroy;
      this.fields = tag.snippet;
      this.submitDelete();
      this.segment.tags.splice(index, 1);
      this.$emit('reload-data');
    },
    wrapSnippet(snippet_start, snippet_end) {
      this.snippet_start = snippet_start;
      this.snippet_end = snippet_end;
    },
    unwrapSnippet() {
      this.snippet_start = null;
      this.snippet_end = null;
    },
    // Segments
    saveSegment(segment, segment_index) {
      // for later
    },
    deleteSegment(segment, segment_index) {
      this.action = segment.links.api_destroy;
      this.text.relationships.segments.splice(segment_index, 1);
      this.confDeleteSegment = true;
      this.fields = segment;
      this.submitDelete();
      this.$emit('reload-data');

    },
    addNewSegmentTag(tags) {
      console.log(tags);
      console.log('segment tag called' + tags);
    }
  }
}
</script>
