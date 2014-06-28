<?

namespace AdventureCamp\ServiceModel;

class SubscriptionState extends \MabeEnum\Enum {
	const Created = 1;
	const Confirmed = 2;
	const Canceled = 3;
}