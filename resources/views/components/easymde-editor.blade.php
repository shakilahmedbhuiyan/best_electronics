<div class="mb-5">
     @if($label ?? null)
        <label for="{{ $name }}" class="form-label block mb-1 font-semibold text-gray-700">
            {{ $label }}
            @if($optional ?? null)
                <span class="text-sm text-gray-500 font-normal">(optional)</span>
            @endif
        </label>
    @endif

    @php $id = $name . Str::random(8); @endphp

    <div
        x-data="{ error: '', showToolbar: true }"
        x-init="
            showToolbar = Boolean('{{ $toolbar ?? true }}');
            document.addEventListener('DOMContentLoaded', () => {
                toolbarSettings = [
                    {
                        name: 'bold',
                        action: EasyMDE.toggleBold,
                        className: 'button-bold',
                        title: 'Bold'
                    },
                    {
                        name: 'italic',
                        action: EasyMDE.toggleItalic,
                        className: 'button-italic',
                        title: 'Italic'
                    },
                    {
                        name: 'strikethrough',
                        action: EasyMDE.toggleStrikethrough,
                        className: 'button-strike',
                        title: 'Strikethrough'
                    },
                    {
                        name: 'heading-2',
                        action: EasyMDE.toggleHeading2,
                        className: 'button-heading-2',
                        title: 'Heading'
                    },
                    {
                        name: 'quote',
                        action: EasyMDE.toggleBlockquote,
                        className: 'button-quote',
                        title: 'Quote'
                    },
                    {
                        name: 'unordered-list',
                        action: EasyMDE.toggleUnorderedList,
                        className: 'button-unordered-list',
                        title: 'Unordered list'
                    },
                    {
                        name: 'ordered-list',
                        action: EasyMDE.toggleOrderedList,
                        className: 'button-ordered-list',
                        title: 'Ordered list'
                    },
                    {
                        name: 'link',
                        action: EasyMDE.drawLink,
                        className: 'button-link',
                        title: 'Create Link'
                    },
                    {
                        name: 'code',
                        action: EasyMDE.toggleCodeBlock,
                        className: 'button-code',
                        title: 'Code'
                    },
                    {
                        name: 'image',
                        action: EasyMDE.drawImage,
                        className: 'button-image',
                        title: 'Insert Image'
                    },
                    {
                        name: 'clean-block',
                        action: EasyMDE.cleanBlock,
                        className: 'button-clean-block',
                        title: 'Clean block'
                    },
                    {
                        name: 'preview',
                        action: EasyMDE.togglePreview,
                        className: 'button-preview no-disable',
                        title: 'Toggle Preview'
                    },
                    {
                        name: 'side-by-side',
                        action: EasyMDE.toggleSideBySide,
                        className: 'button-columns no-disable no-mobile',
                        title: 'Toggle Side by Side'
                    },
                    {
                        name: 'fullscreen',
                        action: EasyMDE.toggleFullScreen,
                        className: 'button-fullscreen no-disable no-mobile',
                        title: 'Toggle Fullscreen'
                    }
                ];
                new EasyMDE({
                    hideIcons: {{ json_encode($hideIcons ?? []) }},
                    status: false,
                    autoDownloadFontAwesome: false,
                    forceSync: true,
                    element: $refs.input,
                    toolbar: showToolbar == true ? toolbarSettings : false,
                    renderingConfig: {
                        codeSyntaxHighlighting: true
                    },
                    indentWithTabs: true,
                    lineWrapping: true,
                    tabSize: 4,
                    placeholder: '{{ $placeholder ?? 'Write something...' }}'
                });
            });
        "
        @js-errors.window="error = $event.detail.errors.{{ $name }} || ''"
        class="relative"
        x-cloak>

        <div
            class="relative"
            :class="{'easymde-haserror' : error.length || '{{ $errors->has($name) }}'}">
            <textarea
                id="{{ $id }}"
                placeholder="{{ $placeholder ?? '' }}"
                {{ $attributes->merge() }}
                x-ref="input">{{ old($name, $value ?? '') }}</textarea>

            @isset($hint)
                <div class="text-sm text-gray-500 my-2 leading-tight help-text">{{ $hint }}</div>
            @endisset

            <div x-show="error.length > 0">
                <svg class="z-20 absolute text-red-600 fill-current w-5 h-5" style="top: 12px; right: 12px"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path
                        d="M11.953,2C6.465,2,2,6.486,2,12s4.486,10,10,10s10-4.486,10-10S17.493,2,11.953,2z M13,17h-2v-2h2V17z M13,13h-2V7h2V13z" />
                </svg>
                <div class="text-red-600 mt-2 text-sm block leading-tight error-text" x-html="error"></div>
            </div>

            @error($name)
                <svg class="z-20 absolute text-red-600 fill-current w-5 h-5" style="top: 12px; right: 12px"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path
                        d="M11.953,2C6.465,2,2,6.486,2,12s4.486,10,10,10s10-4.486,10-10S17.493,2,11.953,2z M13,17h-2v-2h2V17z M13,13h-2V7h2V13z" />
                </svg>
                <div class="text-red-600 mt-2 text-sm block leading-tight error-text">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
