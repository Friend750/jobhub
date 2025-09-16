@push('styles')
    <link rel="stylesheet" href="{{ asset('css/mention-system-logic.css') }}">
@endpush

<div class="mention-dropdown" x-show="showMentionList" @click.outside="showMentionList=false"
    :style="{
        top: {{ isset($CommentsOffsetY) ? $CommentsOffsetY : 'dropdownY' }} + 'px',
        right: {{ isset($CommentsOffsetX) ? $CommentsOffsetX : 'dropdownX' }} + 'px'
    }">
    <template x-for="(user, index) in filteredUsers" :key="user.id">
        <div class="mention-item d-flex align-items-center" :class="{ 'selected': index === selectedIndex }"
            @click="selectUser(user)">
            <img :src="user.avatar ? user.avatar : user.user_image_url" class="mention-avatar ms-2">
            <div>
                <div x-text="user.name"></div>
                <small class="text-muted" x-text="user.user_name"></small>
            </div>
        </div>
    </template>
    <div x-show="filteredUsers.length === 0" class="mention-item text-muted text-center">
        No users found
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('mentionSystem', (wire, itemId) => ({
            CommentContent: @entangle('commentForm.content'),
            ArticleContent: @entangle('articleForm.content'),
            //
            content: '',
            itemEvent: null,
            _itemId: itemId ?? '',
            showMentionList: false,
            mentionQuery: '',
            mentionStartPos: 0,
            selectedIndex: 0,
            dropdownX: 0,
            dropdownY: 0,
            users: @entangle('usersToMention'),

            get filteredUsers() {
                if (!this.mentionQuery) {
                    return this.users;
                } else {
                    return this.users.filter(user =>
                        user.name.toLowerCase().includes(this.mentionQuery.toLowerCase()) ||
                        user.user_name.toLowerCase().includes(this.mentionQuery
                            .toLowerCase())
                    );
                }
            },

            // init
            init() {
                this.$watch('CommentContent', (newVal) => {
                    if (this._itemId === 'CommentContent') {
                        this.content = newVal;
                    }
                });
                this.$watch('ArticleContent', (newVal) => {
                    if (this._itemId === 'postContent') {
                        this.content = newVal;
                    }
                });
            },

            handleInput(event) {
                this.itemEvent = event
                // console.log('content: ' + this.content);
                // console.log('articleContent: ' + this.ArticleContent);
                // console.log('CommentContent: ' + this.CommentContent);



                // console.log(this.users);
                const cursorPosition = event.target.selectionStart;
                const textBeforeCursor = this.content.substring(0, cursorPosition);

                // Check if we're mentioning
                const lastAtPos = textBeforeCursor.lastIndexOf('@');

                // Only trigger mentions if @ is at start or after whitespace
                if (lastAtPos !== -1) {
                    const charBeforeAt = lastAtPos > 0 ? textBeforeCursor[lastAtPos - 1] : '';
                    const isWordStart = lastAtPos === 0 || /\s/.test(charBeforeAt);

                    if (isWordStart) {
                        const textAfterAt = textBeforeCursor.substring(lastAtPos + 1);
                        const hasSpace = textAfterAt.includes(' ');

                        if (!hasSpace) {
                            this.showMentionList = true;
                            // log
                            // console.log(this.showMentionList + ':show list');

                            this.mentionQuery = textAfterAt;
                            this.mentionStartPos = lastAtPos;
                            this.selectedIndex = 0;

                            // Position dropdown near cursor
                            this.positionDropdown(event.target, cursorPosition);
                            return;
                        }
                    }
                }

                this.showMentionList = false;

            },

            // Position dropdown near cursor
            positionDropdown(textarea, cursorPosition) {
                // Calculate cursor coordinates (simplified)
                const lines = this.content.substring(0, cursorPosition).split('\n');
                const currentLine = lines.length;
                const lineHeight = 20; // Approximate line height

                this.dropdownY = currentLine * lineHeight + 110;
                this.dropdownX = 20;
            },

            selectUser(user) {

                const beforeMention = this.content.substring(0, this.mentionStartPos);
                const afterCursor = this.content.substring(
                    this.mentionStartPos + this.mentionQuery.length + 1
                );

                this.content = `${beforeMention}@${user.user_name} ${afterCursor}`;
                UpdateContent();

                // Move cursor to end of inserted mention
                this.$nextTick(() => {
                    const textarea = document.getElementById(this._itemId);
                    const newCursorPos = beforeMention.length + user.user_name.length + 2;

                    textarea.setSelectionRange(newCursorPos, newCursorPos);
                    textarea.focus();
                });
            },

            UpdateContent() {
                if (this._itemId === 'CommentContent') {
                    this.CommentContent = this.content;
                } else {
                    this.ArticleContent = this.content;
                }
            },


        }));
    });
</script>
