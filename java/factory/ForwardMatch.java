class ForwardMatch implements Match {
    public boolean match(String searchWord, String searshedWord) {
        return searshedWord.matches(searchWord + ".*");
    }
}
