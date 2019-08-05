import CommentThreadList from 'CommentWidget/components/molecules/comment-thread-list/comment-thread-list';

export default class CommentThreadListExtended extends CommentThreadList {
    protected show(): void {
        const commentThreadSelect: HTMLSelectElement = <HTMLSelectElement>this.commentThreadSelectComponent;
        this.onShowCommentThread(commentThreadSelect.value);
        this.scrollDown();
    }
}
