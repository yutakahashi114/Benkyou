class PartialMatch implements Match {
    public boolean match(String searchWord, String searshedWord) {
        return searshedWord.matches(".*" + searchWord + ".*");
    }
}
