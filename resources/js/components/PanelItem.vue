<template>
    <div>
        <div v-if="!this.field.gridder" class="flex border-b border-40">
            <div class="w-1/4 py-4">
                <slot>
                    <h4 class="font-normal text-80">{{ label }}</h4>
                </slot>
            </div>
            <div class="w-3/4 py-4 break-words">
                <slot name="value">
                    <p v-if="fieldValue && !shouldDisplayAsHtml" class="text-90">
                        {{ fieldValue }}
                    </p>
                    <div
                        v-else-if="fieldValue && shouldDisplayAsHtml"
                        v-html="field.value"
                    ></div>
                    <p v-else>&mdash;</p>
                </slot>
            </div>
        </div>
        <div v-if="this.field.gridder" class="flex flex-wrap" :class="this.field.gridder.additionalPanelClasses">
            <div v-if="hasSize" :class="[this.field.gridder.labelSize]">
                <slot>
                    <h4 class="nova-grid-field-label font-normal text-80 pb-0 mt-2" :class="this.field.gridder.additionalLabelClasses">{{ label }}</h4>
                </slot>
            </div>
            <div v-if="hasSize" :class="[this.field.gridder.contentSize, this.field.gridder.additionalContentClasses]">
                <slot name="value">
                    <p v-if="fieldValue && !shouldDisplayAsHtml" class="text-90">
                        {{ fieldValue }}
                    </p>
                    <div
                        v-else-if="fieldValue && shouldDisplayAsHtml"
                        v-html="field.value"
                    ></div>
                    <p v-else>&mdash;</p>
                </slot>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            field: {
                type: Object,
                required: true,
            },
            fieldName: {
                type: String,
                default: '',
            },
        },
        computed: {
            label() {
                return this.fieldName || this.field.name
            },

            fieldValue() {
                if (
                    this.field.value === '' ||
                    this.field.value === null ||
                    this.field.value === undefined
                ) {
                    return false
                }

                return String(this.field.value)
            },

            shouldDisplayAsHtml() {
                return this.field.asHtml
            },

            hasSize() {
                return this.field.gridder !== undefined;
            },
        },
    }
</script>
