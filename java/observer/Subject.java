import java.util.*;

public abstract class Subject {
    private List<Observer> observers = new ArrayList<Observer>();
    public void addObserver(Observer observer) {
        this.observers.add(observer);
    };

    public void removeObserver(Observer observer) {
        this.observers.remove(observer);
    };

    public void notifyObservers() {
        for (Observer observer : this.observers) {
            observer.update(this);
        }
    }

    public abstract void run();
}
