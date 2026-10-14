import Alpine from 'alpinejs';
import { Editor } from '@tiptap/core';
import StarterKit from '@tiptap/starter-kit';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('textarea.content-editor').forEach((textarea) => {
        const form = textarea.closest('form');

        if (!form) return;

        const wrapper = document.createElement('div');
        wrapper.className = 'tiptap-wrapper';

        const toolbar = document.createElement('div');
        toolbar.className = 'tiptap-toolbar';

        const editorElement = document.createElement('div');
        editorElement.className = 'tiptap-content';

        textarea.insertAdjacentElement('afterend', wrapper);
        wrapper.append(toolbar, editorElement);

        const editor = new Editor({
            element: editorElement,
            extensions: [StarterKit],
            content: textarea.value.trim()
                ? `<p>${textarea.value
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/\r?\n/g, '</p><p>')}</p>`
                : '<p></p>',
            editorProps: {
                attributes: {
                    class: 'tiptap-prose',
                    dir: 'auto',
                },
            },
        });

        const buttons = [
            ['B', 'Bold', () => editor.chain().focus().toggleBold().run()],
            ['I', 'Italic', () => editor.chain().focus().toggleItalic().run()],
            ['H2', 'Heading 2', () => editor.chain().focus().toggleHeading({ level: 2 }).run()],
            ['H3', 'Heading 3', () => editor.chain().focus().toggleHeading({ level: 3 }).run()],
            ['• List', 'Bullet list', () => editor.chain().focus().toggleBulletList().run()],
            ['1. List', 'Numbered list', () => editor.chain().focus().toggleOrderedList().run()],
            ['❝', 'Blockquote', () => editor.chain().focus().toggleBlockquote().run()],
            ['↶', 'Undo', () => editor.chain().focus().undo().run()],
            ['↷', 'Redo', () => editor.chain().focus().redo().run()],
        ];

        buttons.forEach(([label, title, action]) => {
            const button = document.createElement('button');
            button.type = 'button';
            button.textContent = label;
            button.title = title;
            button.addEventListener('click', action);
            toolbar.appendChild(button);
        });

        const syncContent = () => {
            textarea.value = editor.getHTML();
        };

        editor.on('update', syncContent);
        form.addEventListener('submit', syncContent);

        textarea.hidden = true;
        const hint = textarea.parentElement.querySelector('.hint');

        if (hint) {
            hint.textContent = 'استخدم شريط الأدوات لتنسيق المقال. يتم حفظ التنسيق عند إرسال النموذج.';
        }
    });
});
