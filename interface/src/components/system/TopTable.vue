<template>
  <div class="row col-12 justify-between q-pt-sm">
    <div class="row">
      <q-item class="q-pa-none text-primary" color="primary" v-ripple>
        <q-item-section>
          <q-item-label caption>{{ Meta ? Meta.module_name : "" }}</q-item-label>
          <q-item-label class="text-h6 text-primary"
            >{{ Meta ? Meta.name : "" }} Table</q-item-label
          >
        </q-item-section>
      </q-item>
      <div class="q-ml-md">
        <q-btn
          v-if="trash && table && table.selected.length > 0"
          icon="settings_backup_restore"
          size="sm"
          rounded
          round
          class="bg-grey q-mt-sm text-white q-mr-xs"
          @click="modalConfirm.restore = !modalConfirm.restore"
        >
          <q-tooltip> Restore </q-tooltip>
        </q-btn>
        <!-- DELETE  -->
        <q-btn
          v-if="table && table.selected.length > 0"
          icon="delete"
          size="sm"
          rounded
          round
          class="bg-negative q-mt-sm text-white"
          @click="modalConfirm.delete = !modalConfirm.delete"
        >
          <q-tooltip v-if="trash == false"> Delete </q-tooltip>
          <q-tooltip v-else> Permanent Delete </q-tooltip>
        </q-btn>
      </div>
    </div>

    <div>
      <div class="row items-center">
        <!-- RESTORE  -->

        <!-- TRASH -->
        <div>
          <q-btn
            icon="recycling"
            :class="trash == true ? 'bg-grey-3 text-primary ' : 'bg-primary text-white '"
            @click="getTrash"
            size="sm"
            rounded
            round
          >
            <q-tooltip> Recycle Bin </q-tooltip>
          </q-btn>
        </div>

        <!-- EXPORT  -->
        <q-btn
          color="primary"
          round
          size="sm"
          rounded
          icon="archive"
          class="q-ml-sm"
          no-caps
          @click="$Handle.exportTable(table.columns, table.rows)"
        >
          <q-tooltip> Export CSV </q-tooltip>
        </q-btn>
        <!-- SEARCH TABLE  -->
        <q-input
          outlined
          :model-value="modelValue"
          @update:modelValue="(val) => $emit('update:modelValue', val)"
          label="Search Table"
          dense
          class="q-absolute_label q-ml-sm"
        >
          <template v-slot:append>
            <div>
              <q-btn
                icon="cancel"
                flat
                v-if="modelValue != null"
                @click="seachReset"
                class="q-pa-xs"
                size="md"
                rounded
              />
              <q-icon name="search" v-else />
            </div>
          </template>
        </q-input>

        <div>
          <q-btn
            icon="filter_alt"
            :class="
              filter && $Help.transformQuery(filter.query)
                ? 'bg-grey text-white q-px-sm q-py-sm'
                : 'bg-primary text-white  q-px-sm q-py-sm'
            "
            @click="$emit('onFilter')"
            flat
            size="md"
            rounded
            square
            style="right: 3px; border-radius: 0px 5px 5px 0px"
          >
            <q-tooltip> Filter</q-tooltip>
          </q-btn>
        </div>
        <div class="q-px-xs">
          <q-btn
            label="Add +"
            size="md"
            no-caps
            color="primary"
            class="q-py-sm"
            @click="$emit('add')"
          />
        </div>
      </div>
    </div>
  </div>

  <div class="q-py-sm row col-12 justify-between items-center">
    <!-- MODAL CONFIRM DELETE -->
    <q-dialog v-model="modalConfirm.delete">
      <q-card style="width: 300px">
        <q-card-section>
          <div class="text-h6">
            {{ trash == true ? "Delete Permanent" : "Delete Data" }}
          </div>
        </q-card-section>
        <q-card-section class="q-pt-none" v-if="trash == false">
          are you sure you want to delete the data ?
        </q-card-section>
        <q-card-section class="q-pt-none" v-else>
          are you sure you want to delete the data permanently ?
        </q-card-section>
        <q-card-actions align="right" class="bg-white text-teal">
          <q-btn
            v-if="table && table.selected.length > 0"
            label="Delete"
            size="md"
            rounded
            square
            flat
            class="q-ma-xs q-px-lg bg-negative text-white"
            @click="deleteTirgger"
          />
          <q-btn
            v-if="table && table.selected.length > 0"
            label="Cancel"
            size="md"
            rounded
            square
            flat
            class="q-ma-xs q-px-lg bg-grey text-white"
            v-close-popup
          />
        </q-card-actions>
      </q-card>
    </q-dialog>
    <q-dialog v-model="modalConfirm.restore">
      <q-card style="width: 300px">
        <q-card-section>
          <div class="text-h6">Restore Data</div>
        </q-card-section>
        <q-card-section class="q-pt-none">
          are you sure you want to restore the data ?
        </q-card-section>
        <q-card-actions align="right" class="bg-white text-teal">
          <q-btn
            v-if="table && table.selected.length > 0"
            label="Restore"
            size="md"
            rounded
            square
            flat
            class="q-ma-xs q-px-lg bg-warning text-white"
            @click="restoreTrigger"
          />
          <q-btn
            v-if="table && table.selected.length > 0"
            label="Cancel"
            size="md"
            rounded
            square
            flat
            class="q-ma-xs q-px-lg bg-grey text-white"
            v-close-popup
          />
        </q-card-actions>
      </q-card>
    </q-dialog>
  </div>
</template>
<script>
export default {
  props: ["trash", "modelValue", "table", "filter", "Meta"],
  data() {
    return {
      modalConfirm: { delete: false, restore: false },
    }
  },
  methods: {
    deleteTirgger() {
      this.modalConfirm.delete = false
      this.$emit("delete")
    },
    restoreTrigger() {
      this.modalConfirm.restore = false
      this.$emit("restore")
    },
    getTrash() {
      this.$emit("trash")
    },
    seachReset() {
      this.$emit("seachReset")
    },
  },
}
</script>
