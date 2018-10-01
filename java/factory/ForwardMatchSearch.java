class ForwardMatchSearch extends Search {
    protected Match getSearchMethod() {
        return new ForwardMatch();
    }
}
